import openpyxl

import requests


def get_course_info(course_id):
    # URL and JSON body
    url = "https://colleague-ss.uoguelph.ca/Student/Courses/SearchAsync"
    json_body = {
        "searchParameters": "{\"keyword\":\"" + course_id + "\",\"terms\":[],\"requirement\":null,\"subrequirement\":null,\"courseIds\":null,\"sectionIds\":null,\"requirementText\":null,\"subrequirementText\":\"\",\"group\":null,\"startTime\":null,\"endTime\":null,\"openSections\":null,\"subjects\":[],\"academicLevels\":[],\"courseLevels\":[],\"synonyms\":[],\"courseTypes\":[],\"topicCodes\":[],\"days\":[],\"locations\":[],\"faculty\":[],\"onlineCategories\":null,\"keywordComponents\":[],\"startDate\":null,\"endDate\":null,\"startsAtTime\":null,\"endsByTime\":null,\"pageNumber\":1,\"sortOn\":\"None\",\"sortDirection\":\"Ascending\",\"subjectsBadge\":[],\"locationsBadge\":[],\"termFiltersBadge\":[],\"daysBadge\":[],\"facultyBadge\":[],\"academicLevelsBadge\":[],\"courseLevelsBadge\":[],\"courseTypesBadge\":[],\"topicCodesBadge\":[],\"onlineCategoriesBadge\":[],\"openSectionsBadge\":\"\",\"openAndWaitlistedSectionsBadge\":\"\",\"subRequirementText\":null,\"quantityPerPage\":30,\"openAndWaitlistedSections\":null,\"searchResultsView\":\"CatalogListing\"}"
    }

    # Headers
    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/119.0",
        "Accept": "application/json, text/javascript, */*; q=0.01",
        "Accept-Language": "en-US,en;q=0.5",
        "Accept-Encoding": "gzip, deflate, br",
        "Content-Type": "application/json; charset=utf-8",
        "__RequestVerificationToken": "qpiYzypkv91FGPw9yQ0HjC6Ql0azOWjudMIpJa61cL113FkorX9yeAXAKmPFDQxQoJ_ilZgwzuOOYizw3NTCwT3yKhzn6yhJZmKbSQEDpi81",
        "__IsGuestUser": "true",
        "X-Requested-With": "XMLHttpRequest",
        "Content-Length": "1051",
        "Origin": "https://colleague-ss.uoguelph.ca",
        "DNT": "1",
        "Connection": "keep-alive",
        "Referer": "https://colleague-ss.uoguelph.ca/Student/Courses/Search?keyword=CIS*1300",
        "Cookie": "studentselfservice_uat_ls=7EOoOcYHnJt5XZFXVvgZt_0hM6Ssmi6FEGiJvzbzqsV5M3SvaWHP8Oz78qaqORdrl_ar7DmM2JtgmJdFdh3-lik2sSMhFXphv6yjvEvwllk1; studentselfservice_uat_Sso=W76w80lQJzBG2sfJEo9oJu6l6Wt+5+FgRSlrukib8EzqlFCisKtR2ARj7kTyC3RwdhQCov5SXn2DlBrW6SO3wWmdgLfwkGzDDMDrN86Yp/nbb2jzjnPZjgbKGucWBPEC; __RequestVerificationToken_L1N0dWRlbnQ1=uTPkryfCCRIz3WqWmyOQQlNb8M3VEKhzNDdNCR0x7gowmNpdVeL0Yx3JeNYx9AIhSvnHPrwznzvepXA0zdxVrDjvI0VF5DypRrwQ69WFqNM1",
        "Sec-Fetch-Dest": "empty",
        "Sec-Fetch-Mode": "cors",
        "Sec-Fetch-Site": "same-origin"
    }

    # Make the POST request
    response = requests.post(url, json=json_body, headers=headers)

    res = response.json()['Courses'][0]

    course_name = res['Title']
    description = res['Description']
    credit = res['MinimumCredits']
    return course_name, description, credit


file_path = 'Course_Search_VBA.xlsm'
sheet_name = 'AllCourseData'
sql_file = 'database script/populate_courses.sql'
try:
    # Load the workbook
    workbook = openpyxl.load_workbook(file_path)

    # Select the sheet by name
    sheet = workbook[sheet_name]
    i = 0
    # Iterate through rows in the sheet
    with open(sql_file, 'w') as output_file:
        output_file.write("USE DB_schema;\n")
        for row in sheet.iter_rows(min_row=2, values_only=True):
            # Limit the iteration to the first 10 cells

            if i > 4:
                course_id = row[0]
                sem = [0, 0, 0]
                year = 2023
                course_name, description, credit = get_course_info(course_id)
                credit = str(credit)
                semester = ''
                prereqs = []
                print(course_id+': ', end='')

                for cell_value in row[1:10]:
                    # Handle None values by providing default values or skipping the row
                    value = str(cell_value) if cell_value is not None else ''
                    if value:
                        print(value + " ", end='')

                        if value == 'Fall':
                            sem[0] = 1
                            semester += 'Fall '
                        elif value == 'Winter':
                            sem[1] = 1
                            semester += 'Winter '
                        elif value == 'Summer':
                            sem[2] = 1
                            semester += 'Summer '
                        else:
                            prereqs.append(value)

                print()
                description = description.replace("\"", "\"\"")
                insert_course = f'''
                INSERT INTO Course (course_name, courseID, credit, semester, description) VALUES
                ("{course_name}", '{course_id}', {credit}, '{semester}', "{description}");
                '''
                sql_template = "INSERT INTO Prerequisite (courseID, prerequisite) VALUES\n{}\n;"
                values_template = "('{course}', '{prereq}')"

                values_str = ',\n'.join(values_template.format(
                    course=course_id, prereq=prereq) for prereq in prereqs)

                insert_prereq = sql_template.format(values_str)

                sql_template = "INSERT INTO Semester (courseID, fall, winter, summer, year) VALUES\n{};"

                values_template = "('{course}', {fall}, {winter}, {summer}, {year})"
                values_str = values_template.format(
                    course=course_id, fall=sem[0], winter=sem[1], summer=sem[2], year=year)

                insert_semester = sql_template.format(values_str)

                insert_course = insert_course.strip()
                insert_prereq = insert_prereq.strip()
                insert_semester = insert_semester.strip()
                output_file.write(insert_course+'\n')
                if prereqs:
                    output_file.write(insert_prereq)
                output_file.write("\n")
                output_file.write(insert_semester+'\n')

            i += 1

except FileNotFoundError:
    print(f"File not found: {file_path}")
except Exception as e:
    print(f"An error occurred: {e}")
finally:
    # Close the workbook
    if 'workbook' in locals():
        workbook.close()

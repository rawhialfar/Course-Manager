function generateNodesList(list) {
  let outputArray = [];

  for (let course in list) {
    if (list.hasOwnProperty(course)) {
      let courseId = parseInt(course.match(/\d+/)[0]); // Extract numeric part of the course ID
      outputArray.push({ id: courseId, label: course });
    }
  }

  return outputArray;
}

function generateEdges(courseList, nodes) {
    let edges = [];
    let groupColors = {};

    for (const [courses, prereqs] of Object.entries(courseList)) {
        for (const prereq of prereqs) {
            // Remove brackets and replace or with comma
            const cleanedPrereq = prereq.replace(/[\[\]\(\)]/g, '').replace(/ or /g, ',');
            // Ignore prerequisites with credits
            if (cleanedPrereq.includes('credits')) {
                continue;
            }

            // Split on commas and remove leading/trailing spaces
            const edgeList = cleanedPrereq.split(',').map(item => item.trim());

            for (const course of edgeList) {
                let from, to, color;
                // Extract course code and id with an asterisk
                const match = course.match(/([A-Za-z]+\*)?(\d{4})/);

                if (!match) {
                    continue;
                }

                const [, courseCode, courseId] = match;
                // Find node with matching course code and 4-digit id
                let existingNode = nodes.find(node => node.id === parseInt(courseId) && node.label.startsWith(courseCode));

                // If an exact match is not found, find the node with matching course code and closest 4-digit id
                if (!existingNode) {
                    let closestIdNode = nodes
                        .filter(node => node.label.startsWith(courseCode))

                    if (closestIdNode.length > 0) {
                        closestIdNode = closestIdNode.reduce((prev, curr) => {
                            return Math.abs(curr.id - parseInt(courseId)) < Math.abs(prev.id - parseInt(courseId)) ? curr : prev;
                        });
                    }

                    existingNode = closestIdNode;
                }

                // Check if the node already exists with the courseId
                const existingNodeId = nodes.findIndex(node => node.id === parseInt(courseId));
                const existingLabel = nodes.findIndex(node => node.label === courseCode + courseId);

                // Error check to see if courseId already exists as a node id
                if (existingNodeId !== -1) {
                    // Node with courseId already exists, set the new node's id to the nearest available node id close to courseId
                    to = existingNode.id;
                } else {
                    // Node with courseId doesn't exist, proceed to create a new node
                    if (existingLabel === -1) {
                        // Node label doesn't exist, create a new node
                        to = parseInt(courseId);
                        nodes.push({ id: to, label: courseCode + courseId });
                    } else {
                        // Node label already exists, do not create a new node
                        continue;
                    }
                }

                from = courses.replace(/^\D+/g, '');

                // Check if the group has been assigned a color, if not, assign a new color
                if (!groupColors[prereq]) {
                    groupColors[prereq] = getNextColor(); // Implement getNextColor() to get the next color
                }

                if (!(prereq.includes('or') || prereq.includes('of'))) {
                    color = 'lightgrey';
                } else {
                    color = groupColors[prereq];
                }
                // Create edge data and add to the array
                const edgeData = { from, to, color: { color } };
                edges.push(edgeData);
            }
        }
    }
    return edges;
}

function getNextColor() {
    const colorSet = ['blue', 'red', 'green', 'yellow', 'orange'];
    if (!getNextColor.index || getNextColor.index >= colorSet.length) {
        getNextColor.index = 0;
    }
    const nextColor = colorSet[getNextColor.index];
    getNextColor.index++;
    return nextColor;
}
var educationcount = 0;
var skillcount = 0;
var projectcount = 0;
var jobcount = 0;
var coursecount = 0;

function addEducation() {
    educationcount = educationcount + 1;
    $('#educationSection').append('\
        <div class="eduinner">\
            <div class="row">\
                <div class="col-md-6">\
                    <label for="title">Title :</label>\
                    <input type="text" name="edutitle' + educationcount + '" id="edutitle' + educationcount + '" class="form-control">\
                </div>\
                <div class="col-md-6">\
                    <label for="institute">Institute :</label>\
                    <input type="text" name="institute' + educationcount + '" id="institute' + educationcount + '" class="form-control">\
                </div>\
            </div>\
            <div class="row">\
                <div class="col-md-6">\
                    <label for="finishdate">Date of Completion :</label>\
                    <input type="date" name="educompletion' + educationcount + '" id="educompletion' + educationcount + '" class="form-control">\
                </div>\
                <div class="col-md-6">\
                    <label for="cgpa">CGPA :</label>\
                    <input type="number" name="cgpa' + educationcount + '" id="cgpa' + educationcount + '" class="form-control">\
                </div>\
            </div>\
        </div>');
    return false;
}

function addSkill() {
    skillcount = skillcount + 1;
    $('#skillSection').append('\
    <div class="skillinner">\
    <div class="row">\
        <div class="col-md-6"><label for="title">Title :</label>\
            <input type="text" name="skillTitle' + skillcount + '" id="skillTitle' + skillcount + '" class="form-control">\
        </div>\
        <div class="col-md-6">\
            <label for="level">Level :</label>\
            <select name="level' + skillcount + '" id="level' + skillcount + '" class="form-control">\
                <option value="beginner">Beginner</option>\
                <option value="intermediate">Intermediate</option>\
                <option value="experienced">Experienced</option>\
            </select>\
        </div>\
    </div>\
    </div>');
    return false;
}

function addProject() {
    projectcount = projectcount + 1;
    $('#projectsSection').append('\
    <div class="projectinner">\
    <div class="row">\
        <div class="col-md-6">\
            <label for="title">Title :</label>\
            <input type="text" name="projectTitle' + projectcount + '" id="projectTitle' + projectcount + '" class="form-control">\
        </div>\
        <div class="col-md-6">\
            <label for="description">Description :</label>\
            <textarea name="projectDescription' + projectcount + '" id="projectDescription' + projectcount + '" class="form-control"></textarea>\
        </div>\
    </div>\
    </div>');
    return false;
}

function addJob() {
    jobcount = jobcount + 1;
    $('#jobsSection').append('\
    <div class="jobinner">\
    <div class="row">\
        <div class="col-md-6">\
            <label for="designation">Designation :</label>\
            <input type="text" name="designation' + jobcount + '" id="designation' + jobcount + '" class="form-control">\
        </div>\
        <div class="col-md-6">\
            <label for="company">Company :</label>\
            <input type="textarea" name="company' + jobcount + '" id="company' + jobcount + '" class="form-control">\
        </div>\
    </div>\
    <div class="row">\
        <div class="col-md-6">\
            <label for="from">From :</label>\
            <input type="date" name="jobfrom' + jobcount + '" id="jobfrom' + jobcount + '" class="form-control">\
        </div>\
        <div class="col-md-6">\
            <label for="to">To :</label>\
            <input type="date" name="jobto' + jobcount + '" id="jobto' + jobcount + '" class="form-control">\
        </div>\
    </div>\
    </div>');
    return false;
}


function addCourse() {
    coursecount = coursecount + 1;
    $('#courseSection').append('\
    <div class="eduinner">\
    <div class="row">\
        <div class="col-md-6">\
            <label for="title">Title :</label>\
            <input type="text" name="coursetitle' + coursecount + '" id="coursetitle' + coursecount + '" class="form-control">\
        </div>\
        <div class="col-md-6">\
            <label for="institute">Institute :</label>\
            <input type="text" name="courseinstitute' + coursecount + '" id="courseinstitute' + coursecount + '" class="form-control">\
        </div>\
    </div>\
    <div class="row">\
        <div class="col-md-6">\
            <label for="finishdate">Date of Completion :</label>\
            <input type="date" name="coursecompletion' + coursecount + '" id="coursecompletion' + coursecount + '" class="form-control">\
        </div>\
        <div class="col-md-6">\
            <label for="cgpa">Description :</label>\
            <textarea name="coursedescription' + coursecount + '" id="coursedescription' + coursecount + '" class="form-control"></textarea>\
        </div>\
    </div>\
    </div>');
    return false;
}


function showPreview() {
    var toShow = "";
    toShow = '\
    <div class="row">\
    <div class="col-sm-7">\
        <h1>' + document.getElementById('name').value + '</h1>\
    </div>\
    <div class="col-sm-5" style="text-align: right;">\
        <div>' + document.getElementById('email').value + '</div>\
        <div>' + document.getElementById('phone').value + '</div>\
        <div>' + document.getElementById('city').value + ', ' + document.getElementById('state').value + '</div>\
        <div>' + document.getElementById('website').value + '</div>\
    </div>\
    <div style="background-color: #15173d;height:9px;width:100%"></div>\
    </div>';

    if (educationcount != 0) {
        toShow += '\
        <div class="row" style="margin-top: 25px;">\
            <div class="col-sm-3">\
                <h4>Education</h4>\
            </div>\
            <div class="col-sm-9">';
        for (let i = 1; i <= educationcount; i++) {
            toShow += '\
            <div style="margin-bottom: 20px;">\
            <h4>' + document.getElementById("edutitle" + i).value + '</h4>\
            <div>' + document.getElementById("institute" + i).value + '</div>\
            <div>' + document.getElementById("educompletion" + i).value + '</div>\
            <div>CGPA : ' + document.getElementById('cgpa' + i).value + '/10</div>\
            </div>';
        }
        toShow += '</div></div>'
    }
    if (skillcount != 0) {
        toShow += '\
                    <hr>\
                    <div class="row" style="margin-top: 25px;">\
                        <div class="col-sm-3">\
                            <h4>Skills</h4>\
                        </div>\
                        <div class="col-sm-9 row">';
        for (let i = 1; i <= skillcount; i++) {
            toShow += '\
            <div style="margin-bottom: 20px;width:50%;">\
                                <h4>' + document.getElementById("skillTitle" + i).value + '</h4>\
                                <div>' + document.getElementById("level" + i).value + '</div>\
                            </div>';

        }
        toShow += '</div></div>'
    }
    if (projectcount != 0) {
        toShow += '\
                    <hr>\
                    <div class="row" style="margin-top: 25px;">\
                        <div class="col-sm-3">\
                            <h4>Projects</h4>\
                        </div>\
                        <div class="col-sm-9">';
        for (let i = 1; i <= projectcount; i++) {
            toShow += '\
            <div style="margin-bottom: 20px;">\
                                <h4>' + document.getElementById('projectTitle' + i).value + '</h4>\
                                <div>' + document.getElementById('projectDescription' + i).value + ' </div>\
                            </div>';
        }
        toShow += '</div></div>';
    }

    if (jobcount != 0) {
        toShow += '\
                    <hr>\
                    <div class="row" style="margin-top: 25px;">\
                        <div class="col-sm-3">\
                            <h4>Jobs/Internships</h4>\
                        </div>\
                        <div class="col-sm-9">';
        for (let i = 1; i <= jobcount; i++) {
            toShow += '\
            <div style="margin-bottom: 20px;">\
                                <h4>' + document.getElementById('designation' + i).value + '</h4>\
                                <div>' + document.getElementById('company' + i).value + '</div>\
                                <div>' + document.getElementById('jobfrom' + i).value + ' - ' + document.getElementById('jobto' + i).value + '</div>\
                            </div>';
        }
        toShow += '</div></div>';
    }
    if (coursecount != 0) {
        toShow += '\
        <hr>\
                    <div class="row" style="margin-top: 25px;">\
                        <div class="col-sm-3">\
                            <h4>Trainings/Courses</h4>\
                        </div>\
                        <div class="col-sm-9">';
        for (let i = 1; i <= coursecount; i++) {
            toShow += '\
            <div style="margin-bottom: 20px;">\
                                <h4>' + document.getElementById('coursetitle' + i).value + '</h4>\
                                <div>' + document.getElementById('courseinstitute' + i).value + '</div>\
                                <div>' + document.getElementById('coursecompletion' + i).value + '</div>\
                                <div>' + document.getElementById('coursedescription' + i).value + '</div>\
                            </div>';
        }
        toShow += '</div></div>'
    }
    document.getElementById('mainResume').innerHTML = toShow;
    document.getElementById('formcontainer').classList.add('hidden');
    document.getElementById('previewContainer').classList.remove('hidden');
    return false;
}

function showForm() {
    document.getElementById('formcontainer').classList.remove('hidden');
    document.getElementById('previewContainer').classList.add('hidden');
    return false;
}

function downloadResume() {
    var element = document.getElementById('mainResume');
    var opt = {
        margin: 0,
        filename: 'myfile.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 1 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    // Old monolithic-style usage:
    html2pdf(element, opt);
}
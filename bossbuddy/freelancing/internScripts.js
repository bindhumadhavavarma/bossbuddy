getMyApplications();
showProjects();
showProjectsByMe();

function getMyApplications() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/getMyProjApplications.php",
        data: {

        },
        success: function(html) {
            $("#applicationList").html(html).show();
        }
    });
}

function showProjects() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/showProjects.php",
        success: function(html) {
            $("#internshipsList").html(html).show();
        }
    });
}

function showProjectsByMe() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/showProjectsByMe.php",
        success: function(html) {
            $("#postedInternshipsContainer").html(html).show();
        }
    });
}


function postInternship() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/postProject.php",
        data: {
            designation: document.forms['postInternshipForm']['pDesignation'].value,
            company: document.forms['postInternshipForm']['pCompany'].value,
            skills: document.forms['postInternshipForm']['pSkills'].value,
            duration: document.forms['postInternshipForm']['pDuration'].value,
            stipend: document.forms['postInternshipForm']['pStipend'].value,
        },
        success: function(html) {
            showProjects();
            showProjectsByMe();
            $("#postStatus").html(html).show();
        }
    });
    return false;
}

function viewApplications(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/viewProjApplications.php",
        data: {
            sl: sl
        },
        success: function(html) {
            $("#viewApplicationsList").html(html).show();
        }
    });

    console.log(sl);
    return false;
}

function recruit(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/projrecruit.php",
        data: {
            sl: sl
        },
        success: function() {
            location.reload();
        }
    });

    console.log(sl);
    return false;
}

$(document).ready(function() {
    $("#search").keyup(function() {
        var name = $('#search').val();
        if (name == "") {
            showProjects();
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost/bossbuddy/APIs/searchProjects.php",
                data: {
                    search: name
                },
                success: function(html) {
                    $("#internshipsList").html(html).show();
                }
            });
        }
    });
});
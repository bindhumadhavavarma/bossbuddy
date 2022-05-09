getMyApplications();
showInternships();
showInternshipsByMe();

function getMyApplications() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/getMyApplications.php",
        data: {

        },
        success: function(html) {
            $("#applicationList").html(html).show();
        }
    });
}

function showInternships() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/showInternships.php",
        success: function(html) {
            $("#internshipsList").html(html).show();
        }
    });
}

function showInternshipsByMe() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/showInternshipsByMe.php",
        success: function(html) {
            $("#postedInternshipsContainer").html(html).show();
        }
    });
}


function postInternship() {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/postInternship.php",
        data: {
            designation: document.forms['postInternshipForm']['pDesignation'].value,
            company: document.forms['postInternshipForm']['pCompany'].value,
            skills: document.forms['postInternshipForm']['pSkills'].value,
            duration: document.forms['postInternshipForm']['pDuration'].value,
            location: document.forms['postInternshipForm']['pLocation'].value,
            stipend: document.forms['postInternshipForm']['pStipend'].value,
        },
        success: function(html) {
            showInternships();
            showInternshipsByMe();
            $("#postStatus").html(html).show();
        }
    });
    return false;
}

function viewApplications(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/bossbuddy/APIs/viewApplications.php",
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
        url: "http://localhost/bossbuddy/APIs/recruit.php",
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
            showInternships();
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost/bossbuddy/APIs/searchInternships.php",
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
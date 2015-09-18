function initSchoolList() {
    $.ajax({
        url: "controller/SchoolController.php",
        contentType: 'application/json',
        type: 'get',
        dataType: 'json',
        success: function(data) {
            if (data != null) {
                var schoolSelect = $("#school_id");
                schoolSelect.empty();
                schoolSelect.append("<option value='0'>Select</option>");
                $.each(data, function(index, val) {
                    schoolSelect.append("<option value='" + val.school_id + "' >" + val.name + "</option>");
                });
            } else {
                console.log("error");
            }
        }

    });
}

function initDeptList(school_id){
    $.ajax({
        url: "controller/DeptController.php/dept/" + school_id,
        contentType: 'application/json',
        type: 'get',
        dataType: 'json',
        success: function(data) {
            if (data != null) {
                var dept = $("#dept_id");
                dept.empty();
                dept.attr("disabled", false);
                $.each(data, function(index, val) {
                    dept.append("<option value='" + val.dept_id + "' >" + val.dept_name_abbrev + "</option>");
                });
            } else {
                console.log("error");
            }
        }

    });
}


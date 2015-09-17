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
                    schoolSelect.append("<option value='" + val.school_id
                            + "' >" + val.name + "</option>");
                });
            } else {

            }
        }

    });
}
(function( $ ){

    REGISTER = {
       // var studentInfo = [];

        linkStudentButton: function () {
            var searchAbout = $('#searchLink').val();
            if (searchAbout.length < 3) {
                alert("Min Characters is 3");
                return;
            }
            $.get('/register/searchStudents/' + searchAbout).then(function (data) {
                var html = '';
                 $.each(JSON.parse(data), function( index, value ) {
                     html += "<tr><td>" + value.name + "</td><td>" + value.email + "</td><td class='no-print'><a type='button' onclick='REGISTER.linkStudentFinish("+'"'+ value.name + '", '+'"'+value.email+'",  '+value.id+' '+"  )' class='btn btn-success btn-flat'>Link</a></td></tr>";
                     $('.search_results').html(html);
                 });
            });
        },

        linkStudentFinish: function (name, email, id) {
            var student = {
                'name': name,
                'email': email,
                'id': id
            };
            do {
                var relationShip = prompt("Please enter relationship", "");
            } while (relationShip == "");
            if (relationShip != null && relationShip != "") {
                var studentInfo = $('#studentInfo').val();

                if(studentInfo)
                {
                    var data = JSON.parse(studentInfo);
                    data.push({"student": student.name, "relation": relationShip, "id": "" + student.id + ""});
                    $('#studentInfo').val(JSON.stringify(data));
                }
                else
                {
                    var data = new Array();
                    data.push({"student": student.name, "relation": relationShip, "id": "" + student.id + ""});
                    $('#studentInfo').val(JSON.stringify(data));
                }

                var results = JSON.parse($('#studentInfo').val());
                var html = '';
                $.each(results, function(index, value) {
                    html += '<div class="form-group"><div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" value="' + value.student + '"></div><div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" value="' + value.relation + '"></div><a type="button" onclick="REGISTER.removeStudent('+ index +')" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a></div>';
                });
                $(".studentInfo").html(html);

                $('#UserModal').modal('hide');
                return false;
            }
        },

        removeStudent: function (index) {
            var confirmRemove = confirm("Sure remove this item?");
            if (confirmRemove == true) {
                var results = JSON.parse($('#studentInfo').val());
                $.each(results, function(ind, val) {
                    if (ind == index) {
                        results.splice(val, 1);
                        $('#studentInfo').val(JSON.stringify(results));
                    }
                });
            }
            var results = JSON.parse($('#studentInfo').val());
            var html = '';
            $.each(results, function(index, value) {
                html += '<div class="form-group"><div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" value="' + value.student + '"></div><div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" value="' + value.relation + '"></div><a type="button" onclick="REGISTER.removeStudent('+ index +')" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a></div>';
            });
            $(".studentInfo").html(html);
        },
    }

    var results = JSON.parse($('#studentInfo').val());
    console.log(results);
    var html = '';
    $.each(results, function(index, value) {
        html += '<div class="form-group"><div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" value="' + value.student + '"></div><div class="col-xs-4"><input type="text" class="form-control" disabled="disabled" value="' + value.relation + '"></div><a type="button" onclick="REGISTER.removeStudent('+ index +')" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a></div>';
    });
    $(".studentInfo").html(html);
})( jQuery );

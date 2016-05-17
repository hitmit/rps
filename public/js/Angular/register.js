
var schoex = angular.module('schoex', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<{');
    $interpolateProvider.endSymbol('}>');
});

schoex.controller('registeration', function ($scope, $http) {

    $scope.views = {};
    $scope.classes = {};
    $scope.views.register = true;
    $scope.form = {};
    $scope.form.studentInfo = [];
    $scope.form.role = "teacher";

    $http.get('register/classes').then(function (data) {
        $scope.classes = data.data;
    });

    $scope.tryRegister = function () {
        $http.post("register", $scope.form).success(function(data, status) {
            if(data.error) {
                $scope.submitted = true;
                $scope.error = true;
                $scope.errorMessage = data.error;
            }

            if (data.id) {
                $scope.regId = data.id;
                $scope.changeView("thanks");
            }

        });
    }

    $scope.linkStudent = function () {
        console.log($scope);
        $scope.modalTitle = "Link student To parent";
        $scope.showModalLink = !$scope.showModalLink;
    }

    $scope.linkStudentButton = function () {
        var searchAbout = $('#searchLink').val();
        if (searchAbout.length < 3) {
            alert("Min Characters is 3");
            return;
        }
        $http.get('register/searchStudents/' + searchAbout).then(function (data) {
            $scope.searchResults = data.data;
        });
    }

    $scope.linkStudentFinish = function (student) {
        console.log(student);
        if (typeof ($scope.form.studentInfo) == "undefined") {
            $scope.form.studentInfo = [];
        }
        do {
            var relationShip = prompt("Please enter relationship", "");
        } while (relationShip == "");
        if (relationShip != null && relationShip != "") {
            $scope.form.studentInfo.push({"student": student.name, "relation": relationShip, "id": "" + student.id + ""});
            $scope.showModalLink = !$scope.showModalLink;
        }
    }

    $scope.removeStudent = function (index) {
        var confirmRemove = confirm("Sure remove this item?");
        if (confirmRemove == true) {
            for (x in $scope.form.studentInfo) {
                if ($scope.form.studentInfo[x].id == index) {
                    $scope.form.studentInfo.splice(x, 1);
                    $scope.form.studentInfoSer = JSON.stringify($scope.form.studentInfo);
                    break;
                }
            }
        }
    }

    $scope.changeView = function (view) {
        if (view == "register" || view == "thanks" || view == "show") {
            $scope.form = {};
        }
        $scope.views.register = false;
        $scope.views.thanks = false;
        $scope.views[view] = true;
    }
});

schoex.directive('modal', function () {
    return {
        template: '<div class="modal fade">' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                '<h4 class="modal-title">{{ modalTitle }}</h4>' +
                '</div>' +
                '<div class="modal-body" ng-transclude></div>' +
                '</div>' +
                '</div>' +
                '</div>',
        restrict: 'E',
        transclude: true,
        replace: true,
        scope: true,
        link: function postLink(scope, element, attrs) {
            scope.$watch(attrs.visible, function (value) {
                if (value == true)
                    $(element).modal('show');
                else
                    $(element).modal('hide');
            });

            $(element).on('shown.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = true;
                });
            });

            $(element).on('hidden.bs.modal', function () {
                scope.$apply(function () {
                    scope.$parent[attrs.visible] = false;
                });
            });
        }
    };
});

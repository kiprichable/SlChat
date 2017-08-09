angular.module('starter.controllers', [])

    .controller('HomeCtrl', function ($scope) {

    })
    .controller('LandingCtrl', function ($scope) {

    })

    .controller('PreScreenCtrl', function ($scope, $state, $ionicPopup) {

        $scope.serverSideList = [
            {text: "Yes", value: "Yes"},
            {text: "No", value: "No"},
        ];


        $scope.questions = [
            {
                question: "Are you now, or” to “Do you believe you will become homeless in the next 14 days?”?",
                options: ["Yes", "No"],
            },
            {
                question: "Are you in need of shelter, in a housing crisis, or seeking housing assistance today?",
                options: ["Yes", "No"],
            },

            {
                question: "Are you seeking housing due to concern for your safety, or fear of violence or abuse from another person/partner staying with you?",
                options: ["Yes", "No"],
            },


        ];


        $scope.indexToShow = 0;


        $scope.ctrlData =
        {
            Selected: 'ng'
        };

        //gets the answer
        $scope.change = function (question) {
            var selectedAnswer = $scope.ctrlData.Selected;

            console.log(selectedAnswer);
            console.log(question);
            //if the user answers question 1 as yes direct to next Page

            if (selectedAnswer === '' || selectedAnswer === null) {
                $ionicPopup.alert({
                    title: 'No Answer selected.',
                    template: 'Please select an answer before clicking next.',
                    okText: 'Back', // String, The custom CSS class name
                    okType: 'button button-assertive'
                });
                $scope.indexToShow = ($scope.indexToShow - 1) % $scope.questions.length;
                $state.go('tab.prescreen');
            }
            if (selectedAnswer === 'No' && question === 0) {

                $state.go('contact');
            }
            if (selectedAnswer === 'No' && question === 1) {

                $state.go('contact');
            }
            if (selectedAnswer === 'Yes' && question === 2) {

                $ionicPopup.alert({
                    title: 'Contact.',
                    template: 'If your life is in danger, please call 911. To report domestic abuse please call your' +
                    ' local 211.',
                    okText: 'Continue', // String, The custom CSS class name
                    okType: 'button button-assertive'
                });

                $state.go('appointment');
            }
            if (selectedAnswer === 'No' && question === 2) {
                $state.go('appointment');
            }
            else {
                //clear value for the next input
                $scope.ctrlData.Selected = null;
                $scope.indexToShow = ($scope.indexToShow + 1) % $scope.questions.length;
            }

        };

    })

    .controller('ContactCtrl', function ($scope, $stateParams) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        });
    })
    .controller('ToolsCtrl', function ($scope, $http) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        })
        
    })
    .controller('AppointmentCtrl', function ($scope) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        });
        var date_from = new Date();
        date_from.setDate(date_from.getDate() - 1);
        date_from.setUTCHours(0, 0, 0, 0);

        $scope.minDate = date_from.toISOString().substring(0, 19)

        $scope.goToCheck = function(){

            $state.go('checkappointment');
        };

        $scope.ctrlData =
        {
            members: '',
            age: '',
            vetaran: '',
            stay: '',
            appointmentDate: ''

        };
        $(document).ready(function () {

            $('#db_btn').click(function () {

                var fname = $('#fname').val();
                var lname = $('#lname').val();
                var city = $('#city').val();
                var state = $('#state').val();
                var names = $('#names').val();
                var dd214 = $('#dd214').val();
                var members = $scope.ctrlData.members;
                var age = $scope.ctrlData.age;
                var veteran = $scope.ctrlData.veteran;
                var stay = $scope.ctrlData.stay;
                var date = $('#date').val().substring(0, 10);
                var start = $('#date').val().substring(11, 17);

                $.ajax({
                    method: "post",
                    url: "http://www.txthomeless.com/appointment.php?",
                    data: {
                        fname: fname,
                        lname: lname,
                        city: city,
                        state: state,
                        names: names,
                        dd214: dd214,
                        members: members,
                        age: age,
                        veteran: veteran,
                        stay: stay,
                        date: date,
                        start: start,
                    },
                    success: function (data) {
                        $('#app_results').html(data);
                    }
                })
            })

        })

    })
    .controller('CheckAppointmentCtrl', function ($scope) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        });
        $(document).ready(function () {

            $('#search').click(function () {
                var confirmation = $('#confirmation').val();
                $("#cancel").show();

                $.ajax({
                    method: "post",
                    url: "http://www.txthomeless.com/checkappointment.php?",
                    data: {
                        confirmation: confirmation,
                    },
                    success: function (data) {
                        $('#db_results').html(data);
                    }
                })
            })

            $('#cancel').click(function () {
                var confirmation = $('#confirmation').val();
                $("#cancel").hide();
                $.ajax({
                    method: "post",
                    url: "http://www.txthomeless.com/cancelAppointment.php?",
                    data: {
                        confirmation: confirmation,
                    },
                    success: function (data) {
                        $('#db_results').html(data);
                    }
                })
            })

        })


    })

    .controller('AccountCtrl', function ($scope, $http) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        });
       

        //$scope.user = "Daniel";
    })


    .controller('AboutCtrl', function ($scope) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        });

        //$scope.user = "Daniel";
    })

    .controller('SettingCtrl', function ($scope) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        });

        //$scope.user = "Daniel";
    })


    .controller('ResourcesCtrl', function ($scope) {
        $scope.$on('$ionicView.beforeEnter', function (event, viewData) {
            viewData.enableBack = true;
        })


    });

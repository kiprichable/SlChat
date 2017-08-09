// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic', 'ngCordova','ngCordovaOauth', 'starter.controllers', 'starter.services'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)

    //console.log(ionic.Platform.device());
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider, $ionicConfigProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $ionicConfigProvider.tabs.position('bottom');
  $ionicConfigProvider.tabs.style('standard');
  $ionicConfigProvider.navBar.alignTitle('center');
  $stateProvider

  // setup an abstract state for the tabs directive
    .state('tab', {
    url: '/tab',
    abstract: true,
    templateUrl: 'templates/tabs.html'
  })

  // Each tab has its own nav history stack:

  .state('tab.home', {
    url: '/home',
    views: {
      'tab-home': {
        templateUrl: 'templates/tab-home.html',
        controller: 'HomeCtrl'
      }
    }
  })
      .state('landing', {
          url: "/landing",
          templateUrl: "templates/landing.html",
          controller: 'LandingCtrl'

      })

  .state('tab.prescreen', {
      url: '/prescreen',
      views: {
        'tab-prescreen': {
          templateUrl: 'templates/tab-prescreen.html',
          controller: 'PreScreenCtrl'
        }
      }
    })

      .state('appointment', {
        url: '/appointment',
        templateUrl: 'templates/appointment.html',
        controller: 'AppointmentCtrl'
      })    

  .state('contact', {
    url: '/contact',
    templateUrl: 'templates/contact.html',
    controller: 'AccountCtrl'
  })

      .state('about', {
        url: '/about',
        templateUrl: 'templates/about.html',
        controller: 'AboutCtrl'
      })
      .state('tools', {
          url: '/tools',
          templateUrl: 'templates/tools.html',
          controller: 'ToolsCtrl'
      })

      .state('checkappointment', {
          url: '/checkappointment',
          templateUrl: 'templates/checkappointment.html',
          controller: 'CheckAppointmentCtrl'
      })

      .state('setting', {
          url: '/setting',
          templateUrl: 'templates/setting.html',
          controller: 'SettingCtrl'
      })
      .state('resources', {
        url: '/resources',
        templateUrl: 'templates/resources.html',
        controller: 'ResourcesCtrl'
      });



  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/landing');

});

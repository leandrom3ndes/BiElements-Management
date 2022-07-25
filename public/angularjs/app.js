var bielement=angular.module('bielement',['ngRoute','ngAnimate']);
// Configuration
bielement.config(function($routeProvider){
    $routeProvider
        // Home Page
        .when('/home',{
            templateUrl:'angularjs/templates/bielement-list-template.html',
            controller:'bielementList'
        })
        // Engine List
        .when('/engines',{
            templateUrl:'angularjs/templates/engine-list-template.html',
            controller:'engList'
        })
        // Bielement List According to Engine
        .when('/engine/:eng_id',{
            templateUrl:'angularjs/templates/bielement-list-engine.html',
            controller:'bielementListEngine'
        })
        // Bielement List With Pagination
        .when('/bielement-list/page/:pageNo',{
            templateUrl:'angularjs/templates/bielement-list-template.html',
            controller:'bielementList'
        })
        // Bielement Detail
        .when('/bielementdetail/:bielementId',{
            templateUrl:'angularjs/templates/bielement-detail-template.html',
            controller:'bielementDetail'
        })
        // Member Profile
        .when('/member/profile',{
            templateUrl:'angularjs/templates/member/profile.html',
            controller:'memberProfile'
        })
        // Member Logout
        .when('/member/logout',{
            templateUrl:'angularjs/templates/member/profile.html',
            controller:'memberLogout'
        })
        // Member Login
        .when('/member/login',{
            templateUrl:'angularjs/templates/member/login.html',
            controller:'memberLogin'
        })
        // Member Register
        .when('/member/register',{
            templateUrl:'angularjs/templates/member/register.html',
            controller:'memberRegister'
        })
        // Default
        .otherwise({
            redirectTo:'/home'
        });
});
// All Data Controller
bielement.controller('bielementList',function($http,$routeParams){
    // Get All BiElements
    var self=this;
    self.allbielements='';
    self.pageLinks='';
    self.countbielement=0;
    self.pageLinks=0;
    self.maxSize=12;
    self.pageClass='';
    self.currentPage=1;
    $http({
        method:'POST',
        data:{
            page:$routeParams.pageNo,
            limit:12
        },
        url:appUrl+'/all'
    }).then(function(response){
        self.allbielements=response.data.allbielements;
        self.countbielement=response.data.totalbielements;
        self.pageLinks=Math.ceil(self.countbielement/self.maxSize);
        self.currentPage=$routeParams.pageNo;
    });

    // Search Result
    self.searchClick=function(){
        $http({
            method:'POST',
            data:{
                searchText:self.searchText
            },
            url:appUrl+'/search'
        }).then(function(response){
            self.allbielements=response.data.allbielements;
            self.countbielement=response.data.countAll;
        });
    };

    // When Click on pagination link
    self.pageLinkClick=function(current_page){
        $http({
            method:'POST',
            data:{
                page:current_page,
                limit:self.maxSize
            },
            url:appUrl+'/all'
        }).then(function(response){
            self.allbielements=response.data.allbielements;
            self.countbielement=response.data.totalbielements;
            self.pageLinks=Math.ceil(self.countbielement/self.maxSize);
            self.currentPage=$routeParams.pageNo;
        });
    };

});

// Single Data Controller
bielement.controller('bielementDetail',function($http,$routeParams){
    var self=this;
    self.allbielements='';
    self.memberData='';
    self.memberLogRes='';
    self.collected=false;
    // Bielement Detail
    $http({
        method:'POST',
        data:{
            bi_id:$routeParams.bielementId
        },
        url:appUrl+'/detail'
    }).then(function(response){
        self.bielementData=response.data;
    });
    // Collection this bielement
    self.collectbielement=function(bi_id){
        // Check User is logged In or Not
        $http({
            method:'GET',
            url:appUrl+'/member/check_session'
        }).then(function(response){
            if(response.data.bool==false){
                self.memberLogRes='You are not loggedIn';
                alert('Necessita de fazer login para colecionar este BI Element.');
            }else{
                self.memberData=response.data.memberData[0];
                $http({
                    method:'POST',
                    data:{
                        bi_id:bi_id,
                        member_id:self.memberData.member_id
                    },
                    url:appUrl+'/member/collect'
                }).then(function(response){
                    if(response.data.bool==true){
                        self.collected=true;
                    }else{
                        self.collected=false;
                        alert('Já se encontra na sua coleção.');
                    }
                });
            }
        });
    };
});

// Engine Controller
bielement.controller('engList',function($http){
    var self=this;
    self.allCats='';
    $http({
        method:'GET',
        url:appUrl+'/engines'
    }).then(function(response){
        self.allCats=response.data.allCats;
    });
});

// Bielement List Via Engine
bielement.controller('bielementListEngine',function($http,$routeParams){
    var self=this;
    $http({
        method:'GET',
        url:appUrl+'/engine/'+$routeParams.eng_id
    }).then(function(response){
        self.bielementData=response.data;
    });
});

// Pagination Filter
bielement.filter('range', function(){
    return function(input, total) {
      total = parseInt(total);
      for (var i=1; i<total; i++)
        input.push(i);
      return input;
    };
});


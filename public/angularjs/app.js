var bielement=angular.module('bielement',['ngRoute','ngAnimate']);
// Configuration
bielement.config(function($routeProvider){
    $routeProvider
        // Home Page
        .when('/home',{
            templateUrl:'angularjs/templates/book-list-template.html',
            controller:'bookList'
        })
        // Engine List
        .when('/engines',{
            templateUrl:'angularjs/templates/engine-list-template.html',
            controller:'catList'
        })
        // Bielement List According to Engine
        .when('/engine/:eng_id',{
            templateUrl:'angularjs/templates/book-list-engine.html',
            controller:'bookListCategory'
        })
        // Bielement List With Pagination
        .when('/book-list/page/:pageNo',{
            templateUrl:'angularjs/templates/book-list-template.html',
            controller:'bookList'
        })
        // Bielement Detail
        .when('/bookdetail/:bookId',{
            templateUrl:'angularjs/templates/book-detail-template.html',
            controller:'bookDetail'
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
bielement.controller('bookList',function($http,$routeParams){
    // Get All BiElements
    var self=this;
    self.allBooks='';
    self.pageLinks='';
    self.countBook=0;
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
        self.allBooks=response.data.allBooks;
        self.countBook=response.data.totalBooks;
        self.pageLinks=Math.ceil(self.countBook/self.maxSize);
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
            self.allBooks=response.data.allBooks;
            self.countBook=response.data.countAll;
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
            self.allBooks=response.data.allBooks;
            self.countBook=response.data.totalBooks;
            self.pageLinks=Math.ceil(self.countBook/self.maxSize);
            self.currentPage=$routeParams.pageNo;
        });
    };

});

// Single Data Controller
bielement.controller('bookDetail',function($http,$routeParams){
    var self=this;
    self.allBooks='';
    self.memberData='';
    self.memberLogRes='';
    self.collected=false;
    // Bielement Detail
    $http({
        method:'POST',
        data:{
            bi_id:$routeParams.bookId
        },
        url:appUrl+'/detail'
    }).then(function(response){
        self.bookData=response.data;
    });
    // Collection this book
    self.collectBook=function(bi_id){
        // Check User is logged In or Not
        $http({
            method:'GET',
            url:appUrl+'/member/check_session'
        }).then(function(response){
            if(response.data.bool==false){
                self.memberLogRes='You are not loggedIn';
                alert('You are not loggedIn!! Please Login to collect this ebook.');
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
                        alert('Already in Your Collection');
                    }
                });
            }
        });
    };
});

// Engine Controller
bielement.controller('catList',function($http){
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
bielement.controller('bookListCategory',function($http,$routeParams){
    var self=this;
    $http({
        method:'GET',
        url:appUrl+'/engine/'+$routeParams.eng_id
    }).then(function(response){
        self.bookData=response.data;
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

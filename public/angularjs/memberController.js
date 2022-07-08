// Profile Controller
biElement.controller('memberProfile',function($http,$location){
    var self=this;
    self.memberData='';
    self.collections='';
    // Get Collection of my books
    $http({
        method:'GET',
        url:appUrl+'/member/my_collection'
    }).then(function(response){
        self.collections=response.data.allData;
        console.log(self.collections);
    });
    // Check User Session is working or not
    $http({
        method:'GET',
        url:appUrl+'/member/check_session'
    }).then(function(response){
        if(response.data.bool==false){
            $location.path('member/login');
        }else{
            console.log(response);
            self.memberData=response.data.memberData[0];
        }
    });
});
// Login Controller
biElement.controller('memberLogin',function($http,$location){
    var self=this;
    self.error=false;
    self.session=false;
    self.loginClick=function(){
        $http({
            method:'POST',
            data:{
                member_email:self.email,
                member_pwd:self.password
            },
            url:appUrl+'/member/login'
        }).then(function(response){
            if(response.data.bool==true){
                self.session=true;
                $location.path('member/profile');
                location.reload();
            }else{
                self.error=true;
            }
        });
    };
});
// Member Logout Contoller
biElement.controller('memberLogout',function($http,$location){
    $http({
        method:'GET',
        url:appUrl+'/member/logout'
    }).then(function(response){
        if(response.data.bool==true){
            $location.path('member/login');
            location.reload();
        }
    });
});

// Register Controller
biElement.controller('memberRegister',function($http){
    var self=this;
    self.showMsg=false;
    self.formMsg=false;
    self.resClass='';
    self.formBool=false;
    self.regClick=function(){
        if(self.full_name=='' || self.email=='' || self.password==''){
            self.formMsg='Please enter all Fields!!';
            self.resClass='alert alert-warning';
            self.formBool=true;
        }else{
            $http({
                method:'POST',
                url:appUrl+'/member/register',
                data:{
                    member_fullname:self.full_name,
                    member_email:self.email,
                    member_pwd:self.password
                }
            }).then(function(response){
                var responseData=response.data;
                self.showBool=responseData.bool;
                self.showMsg=responseData.msg;
                if(self.showBool==true){
                    self.full_name='';
                    self.email='';
                    self.password='';
                    self.resClass='alert alert-success';
                }else{
                    self.resClass='alert alert-warning';
                }
            });
        }
    };
});
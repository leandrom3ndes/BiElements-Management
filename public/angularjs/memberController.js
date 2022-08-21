// Profile Controller
bielement.controller('memberProfile',function($http,$location){
    var self=this;
    self.memberData='';
    self.collections='';
    // Get Collection of bielements
    $http({
        method:'GET',
        url:appUrl+'/member/member_collection'
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
bielement.controller('memberLogin',function($http,$location){
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
                //$location.path('member/profile');
                location.reload();
                $location.path('member/profile');
                
            }else{
                self.error=true;
            }
        });
    };
});
// Member Logout Contoller
bielement.controller('memberLogout',function($http,$location){
    $http({
        method:'GET',
        url:appUrl+'/member/logout'
    }).then(function(response){
        if(response.data.bool===true){
            $location.path('member/login');
            if(typeof(localStorage.getItem('rlcount')) == 'undefined'){
                localStorage.setItem('rlcount', 0);
            }
            if(localStorage.getItem('rlcount') < 2){
                localStorage.setItem('rlcount', localStorage.getItem('rlcount') + 1);
                window.location.reload();
            }else{
                localStorage.removeItem('rlcount');
            }
        }else{
            self.error=true;
        }
    });
});

// Register Controller
bielement.controller('memberRegister',function($http){
    var self=this;
    self.showMsg=false;
    self.formMsg=false;
    self.resClass='';
    self.formBool=false;
    self.regClick=function(){
        if(self.full_name=='' || self.email=='' || self.password==''){
            self.formMsg='Por favor insira todos os campos!';
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

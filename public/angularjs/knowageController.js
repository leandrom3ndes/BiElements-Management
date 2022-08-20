// Knowage Controller
bielement.controller('knowageLogin',function($http, $location){

    /*
        *  setup some basic informations in order to invoke Knowage server's services
    */
    Sbi.sdk.services.setBaseUrl({
        protocol: 'http'
        , host: 'localhost'
        , port: '8080'
        , contextPath: 'knowage'
        , controllerPath: 'servlet/AdapterHTTP'
    });

    var self=this;
    self.showMsg=false;
    self.formMsg=false;
    self.resClass='';
    self.formBool=false;
    
    self.knowageAuth=function(){
        if(self.knowageName=='' || self.knowagePass==''){
            self.formMsg='Por favor preencha todos os campos!';
            self.resClass='alert alert-warning';
            self.formBool=true;
        }else{
            var userKnowage = document.getElementById('knowageName');
            var passworKnowage = document.getElementById('knowagePass');
            var user = userKnowage.value;
            var password = passworKnowage.value;

            /*
            * the callback invoked uppon request termination
            *
            * @param xhr the XMLHttpRequest object
            */
            var cb = function(xhr) {
                /*var authenticationEl =  document.getElementById('authentication');
                var knowageEmbed =  document.getElementById('knowageEmbed');
                authenticationEl.style.display = "none";
                knowageEmbed.style.display = "inline";*/
                var self=this;
                self.allCats='';
                $http({
                    method:'GET',
                    url:appUrl+'/knowage/all'
                }).then(function(response){
                    self.allCats=response.data.allCats;
                });
            };
            /*
                * authentication function
                *
                * @param credentials the list of parameters to pass to the authentication servics (i.e. user & password)
                * @param headers an array containing the headers of the request
                * @param callbackOk the callback function to be called after success response
                * @param callbackError (optional) the callback function to be called after error response
            */
            Sbi.sdk.cors.api.authenticate({
                credentials: 'user=' + user + '&password=' + password
                , headers: [{
                    name: 'Content-Type',
                    value: 'application/x-www-form-urlencoded'
                }]
                , callbackOk: cb
            })    
        }
    };
});


// All Data Controller
bielement.controller('knowageList',function($http,$routeParams){
    // Get All BiElements
    var self=this;
    self.allknowage='';
    self.pageLinks='';
    self.countknowage=0;
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
        url:appUrl+'/knowage/all'
    }).then(function(response){
        self.allknowage=response.data.allknowage;
        self.countknowage=response.data.totalbielements;
        self.pageLinks=Math.ceil(self.countknowage/self.maxSize);
        self.currentPage=$routeParams.pageNo;
    });

    // Search Result
    self.searchClick=function(){
        $http({
            method:'POST',
            data:{
                searchText:self.searchText
            },
            url:appUrl+'/knowage/search'
        }).then(function(response){
            self.allknowage=response.data.allknowage;
            self.countknowage=response.data.countAll;
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
            url:appUrl+'/knowage/all'
        }).then(function(response){
            self.allknowage=response.data.allknowage;
            self.countknowage=response.data.totalbielements;
            self.pageLinks=Math.ceil(self.countknowage/self.maxSize);
            self.currentPage=$routeParams.pageNo;
        });
    };

});

// Single Data Controller
bielement.controller('knowageDetail',function($http,$routeParams){
    var self=this;
    self.allknowages='';
    self.memberData='';
    self.memberLogRes='';
    self.collected=false;
    // Bielement Detail
    $http({
        method:'POST',
        data:{
            knowage_id:$routeParams.knowageDocId
        },
        url:appUrl+'/knowage/detail'
    }).then(function(response){
        self.knowageData=response.data;
        console.log("RESULTADO PRIMEIRO: " + self.knowageData.documentDescription)
    });

    self.knowageEmbed=function(){
        console.log("RESULTADO SEGUNDOO: " + self.knowageData.executionRole);
        Sbi.sdk.api.injectDocument({
            documentLabel: self.knowageData.documentLabel
            , documentName: self.knowageData.documentName
            , executionRole: self.knowageData.executionRole
            , displayToolbar: self.knowageData.displayToolbar
            , canResetParameters: self.knowageData.canResetParameters
            , displaySliders: self.knowageData.displaySliders
            , target: 'targetDiv'
            , iframe: {
                style: 'border: 0px; height:100vh; width:100%;'
            }
            , useExtUI: true
        });
    };

    self.knowageGetDataSetList=function(){
        Sbi.sdk.cors.api.getDataSetList({
            callbackOk: function(obj) {
                str = '';
                
                for (var key in obj){
                    str += "<tr><td>" + obj[key].label + "</td><td>" + obj[key].name + "</td><td>" + obj[key].description + "</td></tr>";
                }
                
                document.getElementById('knowageDatasetsList').innerHTML = str;
            }
        });
    };

    self.knowageExecuteDataSet=function(){
        Sbi.sdk.cors.api.executeDataSet({
            datasetLabel: self.knowageData.datasetLabel
            , parameters: {
                par_year: 1998,
                par_family: 'Food'
            }
            , callbackOk: function(obj) {
                var str = "<th>Id</th>";
                
                var fields = obj.metaData.fields;
                for(var fieldIndex in fields) {
                    if (fields[fieldIndex].hasOwnProperty('header'))
                        str += '<th>' + fields[fieldIndex]['header'] + '</th>';
                }
                
                str += '<tbody>';
                
                var rows = obj.rows;
                for (var rowIndex in rows){
                    str += '<tr>';
                    for (var colIndex in rows[rowIndex]) {
                        str += '<td>' + rows[rowIndex][colIndex] + '</td>';
                    }
                    str += '</tr>';
                }
                
                str += '</tbody>';
                
                document.getElementById('knowageDataset').innerHTML = str;
            }
        });
    };

});


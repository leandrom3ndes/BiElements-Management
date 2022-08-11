// Knowage Controller
bielement.controller('knowageLogin',function($http){

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
                var authenticationEl =  document.getElementById('authentication');
                var knowageEmbed =  document.getElementById('knowageEmbed');
                authenticationEl.style.display = "none";
                knowageEmbed.style.display = "inline";
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

    self.knowageEmbed=function(){

        var html = Sbi.sdk.api.getDocumentHtml({
            documentLabel: 'Foodmart'
            , documentName: 'Foodmart'
            , executionRole: '/spagobi/user'
            , parameters: {par: 'test', par2: 'test2'}
            , displayToolbar: true
            , canResetParameters: false
            , iframe: {
                height: '500px'
                , width: '100%'
                , style: 'border: 0px; input:focus{outline: none !important;}'
            }
        });
        var dashboard = document.getElementById('targetDiv');
        dashboard.style.display = "inline";
        dashboard.innerHTML = html;
        //document.getElementById('targetDiv').innerHTML = html;
    };

    /*
        Sbi.sdk.api.injectDocument({
            documentLabel: 'DEMO_Report'
            , documentName: 'Store Sales Analysis'
            , executionRole: '/spagobi/user'
            , parameters: {par: 'test', par2: 'test2'}
            , displayToolbar: true
            , canResetParameters: true
            , target: 'targetDiv'
            , iframe: {
                style: 'border: 0px; height:100vh; width:100%; input:focus{outline: none !important;}'
            }
            , useExtUI: true
        });
    };*/

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
            datasetLabel: 'DEMO_Report'
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


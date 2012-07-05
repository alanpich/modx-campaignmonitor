MCM.window.TestCampaign = function(config) {
    config = config || {};
    Ext.applyIf(config,{
    	id: 'mcm-window-testcampaign'
        ,title: _('mcm.test_this_campaign')
        ,url: MCM_CONNECTORS+'connector.php'
        ,saveBtnText: _('.mcm.schedule_campaign')
        ,cancelBtnText: _('mcm.cancel')
		,success: function(obj,res){
			console.log(arguments);
			MODx.msg.status({
				title: _('mcm.test_email_sent')
				,message: _('mcm.test_email_message',{email: res.result.message} )
				,delay: 3
			});
		}
		,beforeSubmit: function(){
			this.hide();	
		}
        ,baseParams: {
            action: 'campaigns/test'
			,waitTitle: 'Sending test...'
        }
		,listeners:{
			show:function(field, newVal, oldVal){
			}
    	}
        ,fields: [{
            xtype: 'textfield'
            ,name: 'send_to'
            ,fieldLabel: _('mcm.send_to')
			,labelAlign: 'left'
            ,anchor: '100%'
        },{	   		
			xtype: 'hidden'
	   		,fieldLabel: 'ID#'
	   		,name: 'campaignid'
	   		,anchor: '100%'
	   		,value: ''
	   }]
    });
    MCM.window.TestCampaign.superclass.constructor.call(this,config);
};
Ext.extend(MCM.window.TestCampaign,MODx.Window);
Ext.reg('mcm-window-testcampaign',MCM.window.TestCampaign);

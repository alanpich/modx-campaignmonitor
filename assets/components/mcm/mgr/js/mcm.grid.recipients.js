MCM.grid.Recipients = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'mcm-grid-recipients'
        ,url: MCM_CONNECTORS+'connector.php'
        ,baseParams: { action: 'recipientlists/getList' }
        ,fields: ['ListID','Name']
        ,paging: true
        ,remoteSort: false
        ,anchor: '97%'
        ,autoExpandColumn: 'subject'
        ,columns: [{
            header: _('mcm.campaignTitle')
            ,dataIndex: 'ListID'
            ,sortable: true
	    },{
            header: _('mcm.emailSubject')
            ,dataIndex: 'Name'
            ,sortable: true
        }]
        ,tbar:[{
            text: _('mcm.newCampaign')
            ,handler: { xtype: 'mcm-window-newcampaign' ,blankValues: true }
        },{
        	xtype: 'mcm-combo-recipientlists'
			,fieldLabel: 'Select Recipient List'
            ,name: 'recipientlist'
            ,hiddenName: 'recipientlist'
            ,anchor: '100%'        	
        }]
    });
    MCM.grid.Recipients.superclass.constructor.call(this,config)
};
Ext.extend(MCM.grid.Recipients,MODx.grid.Grid);
Ext.reg('mcm-grid-recipients',MCM.grid.Recipients);


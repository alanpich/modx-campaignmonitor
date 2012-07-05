MCM.grid.DraftCampaigns = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'mcm-grid-draftcampaigns'
        ,url: MCM_CONNECTORS+'connector.php'
        ,baseParams: { action: 'campaigns/getDraftList' }
        ,fields: ['id','title','subject','created','preview','listID']
        ,paging: true
		,pageSize: 10
		,showPerPage: false
        ,remoteSort: false
		,preventRender: true
        ,anchor: '97%'
        ,autoExpandColumn: 'subject'
        ,columns: [{
            header: _('mcm.draftCampaigns')
            ,dataIndex: 'title'
            ,sortable: true
	    },{
            header: _('mcm.emailSubject')
            ,dataIndex: 'subject'
            ,sortable: true
        },{
            header: _('created')
            ,dataIndex: 'created'
            ,sortable: true
			,renderer : Ext.util.Format.dateRenderer('d-m-Y, g:i A')
        },{
            header: ''
            ,dataIndex: 'preview'
            ,sortable: false
			,renderer: MCMdraftCampaignButtons
			,locked: true
			,align: 'right'
        }]
    });
    MCM.grid.DraftCampaigns.superclass.constructor.call(this,config)
};
Ext.extend(MCM.grid.DraftCampaigns,MODx.grid.Grid);
Ext.reg('mcm-grid-draftcampaigns',MCM.grid.DraftCampaigns);



function MCMdraftCampaignButtons(a,b,record){
		var id = Ext.id();
		var html = MCMpreviewCampaignButton(id,record)
       		html+= MCMtestCampaignButton(id,record)
       		html+= MCMscheduleCampaignButton(id,record)
       		html+= MCMdeleteCampaignButton(id,record)
       
       return(html);
	};
	
function MCMscheduledCampaignButtons(a,b,record){
		var id = Ext.id();
		var html = MCMpreviewCampaignButton(id,record)
       		html+= MCMcancelCampaignButton(id,record)
       
       return(html);
	};
	
function MCMsentCampaignButtons(a,b,record){
		var id = Ext.id();
		var html = MCMpreviewCampaignButton(id,record)
       		html+= MCMdeleteCampaignButton(id,record)
       
       return(html);
	};







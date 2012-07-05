Ext.onReady(function() {
    MODx.load({ xtype: 'mcm-page-main'});
});

MCM = {
	page: {}, panel: {}, grid:{}, window:{}, combo:{}
}
 
MCM.page.Main = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'mcm-panel-main'
            ,renderTo: 'mcm-panel-main-div'
        },{
            xtype: 'mcm-window-schedulecampaign'
        },{
            xtype: 'mcm-window-testcampaign'
        }]
    });
    MCM.page.Main.superclass.constructor.call(this,config);
};
Ext.extend(MCM.page.Main,MODx.Component);
Ext.reg('mcm-page-main',MCM.page.Main);



function MCMdeleteCampaign( campaignID){
		MODx.msg.confirm({
		   title: _('mcm.delete_this_campaign')
		   ,text: _('mcm.delete_campaign_warning')
		   ,url: MCM_CONNECTORS+'connector.php'
		   ,params: {
			  campaignID: campaignID
			  ,action: 'campaigns/delete'
		   }
		   ,listeners: {
				'success':{fn: function(r) {
					Ext.getCmp('mcm-grid-campaigns').refresh();
					Ext.getCmp('mcm-grid-draftcampaigns').refresh();
				     
				 },scope:true}
		   }
		});		
		return false;
	}//
	
function MCMscheduleCampaign( obj, id, listID ){
		w = Ext.getCmp('mcm-window-schedulecampaign');
		w.setValues({ 
			 campaignid: id
			 ,title: $(obj).attr('data-title')
			 ,ListID: $(obj).attr('data-listid')
		});
		var combo = Ext.getCmp('mcm-campaign-schedule-recipientlists');
		if( listID !== "0"){
			combo.hide();
			combo.setValue(listID);
		};
		w.show();	
		return false;
	};

function MCMunscheduleCampaign( campaignID){
		MODx.msg.confirm({
		   title: _('mcm.unschedule_this_campaign')
		   ,text: _('mcm.unschedule_campaign_warning')
		   ,url: MCM_CONNECTORS+'connector.php'
		   ,params: {
			  campaignID: campaignID
			  ,action: 'campaigns/unschedule'
		   }
		   ,listeners: {
				'success':{fn: function(r) {
					Ext.getCmp('mcm-grid-scheduledcampaigns').refresh();
					Ext.getCmp('mcm-grid-draftcampaigns').refresh();
				     
				 },scope:true}
		   }
		});		
		return false;
	}//

function MCMtestCampaign( campaignID ){
		w = Ext.getCmp('mcm-window-testcampaign');
		w.setValues({ 
			 campaignid: campaignID
		});
		w.show();	
		return false;
	}//


function MCMpreviewCampaignButton(id, record){
		return '<a href="'+record.data.preview+'"  class="mcm-icon mcm_campaign-preview-url"><img src="'+MCM_ASSETS+'mgr/css/img/icon-preview.png" title="'+_('mcm.preview_this_campaign')+'" /></a>'
	};
function MCMscheduleCampaignButton(id, record){
		MCM.__tmp_record = record;
		return '<a id="'+id+'_s" href="#" onclick="return MCMscheduleCampaign(this, \''+record.data.id+'\',\''+record.data.listID+'\')" data-listid="'+record.data.listID+'" data-title="'+record.data.title+'" title="'+_('mcm.schedule_this_campaign')+'" class="mcm-icon"><img src="'+MCM_ASSETS+'mgr/css/img/icon-schedule.png" /></a>'
	};
function MCMdeleteCampaignButton(id, record){
		return '<a id="'+id+'_d" href="#" onclick="return MCMdeleteCampaign(\''+record.data.id+'\')" title="'+_('mcm.delete_this_campaign')+'" class="mcm-icon"><img src="'+MCM_ASSETS+'mgr/css/img/icon-delete.png" /></a>'
	};
function MCMcancelCampaignButton(id, record){
		return '<a id="'+id+'_u" href="#" onclick="return MCMunscheduleCampaign(\''+record.data.id+'\')" title="'+_('mcm.unschedule_this_campaign')+'" class="mcm-icon"><img src="'+MCM_ASSETS+'mgr/css/img/icon-unschedule.png" /></a>'
	};
function MCMtestCampaignButton(id, record){
		return '<a id="'+id+'_t" href="#" onclick="return MCMtestCampaign(\''+record.data.id+'\')" title="'+_('mcm.test_this_campaign')+'" class="mcm-icon"><img src="'+MCM_ASSETS+'mgr/css/img/icon-email.png" /></a>'
	};




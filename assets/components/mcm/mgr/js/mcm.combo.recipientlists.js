MCM.combo.RecipientLists = function(config){
    config = config || {};
    Ext.applyIf(config,{
        id: 'mcm-combo-recipientlists' 
		,name: 'recipientList'
		,hiddenName: 'recipientList'
        ,displayField: 'title'
        ,valueField: 'id'
		,mode: 'remote'
		,fields: ['id','title']
		,forceSelection: true
		,editable: false
        ,enableKeyEvents: true
		,paging: false
		,pageSize: 20
        ,url: MCM_CONNECTORS+'connector.php'
        ,baseParams: { 
			 action: 'recipientlists/getList'
			,showNone: true
		}         
    });
    MCM.combo.RecipientLists.superclass.constructor.call(this, config);
};
Ext.extend(MCM.combo.RecipientLists,MODx.combo.ComboBox);
Ext.reg('mcm-combo-recipientlists',MCM.combo.RecipientLists);


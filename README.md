CampaignMonitor integration for ModX Revo 2.2+
==============================================

Send CampaignMonitor emails direct from Modx using resources as the content of the email.


###v1.0.0 Released 
*2nd September 2012* ~
I have created a transport package for this extra so it can be released and tested. At the moment 
functionality is limited to creating, testing, sheduling and reporting on campaigns, although I do 
plan to add support for recipient list administration in the future.

#### Installation Guide
* Download the [transport package](https://github.com/downloads/alanpich/modx-campaignmonitor/mcm-1.0.0-pl.transport.zip)
* Place .zip file in your core/packages directory and install via the package manager.
* The installer will create several system settings under the namespace `mcm`. These must all be populated 
or the package may not work as expected. (todo - add field population the installer)
* Manage your campaignmonitor emails from the components/Campaign Monitor menu in the manager interface

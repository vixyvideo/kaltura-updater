#DO NOT USE THIS ON A PRODUCTION SERVER! NO WARRANTY

#Prerequisites
Install the following tools to aid in the update process. 

###Debian
apt-get install subversion sshpass

###Centos 
yum install svn sshpass 

###Workstation
To aid in database schema comparisons, install mysqlworkbench. With this tool you will be able to compare database dumps, and create delta alter scripts to fix any missed updates. 

---

# 1 Normal installation
Before upgrading any kaltura release. You should first install and verrify that the new kaltura release is working correctly. Installing kaltura has been  documented on github. It is advised you use the new RPM based installation. 

https://github.com/kaltura/platform-install-packages/blob/master/doc/install-kaltura-redhat-based.md#non-ssl-step-by-step-installation

### 1.1 Verify
After succesfully installing kaltura. First run:

/opt/kaltura/bin/kaltura-sanity.sh

Only when everything passes. Proceed to the next step.

### 1.2 Export working kaltura schemas
Export the following kaltura schemas:

- kaltura
- kalturadw
- kalturadw_bisources
- kalturadw_ds
- kalturalog
- kaltura_sphinx_log

> mysqldump -uroot -p --routines schema > [schema].sql

### 1.3 Export data 
While upgrading kaltura, some data migrations are missed. These are:

- delivery_profile (Export all data)
- dynamic_enum (Export all data)
- partner   (Export all partners with id < 100)
- ui_conf  (Export all uiconfs belonging to partner < 100 )

The exporting is best done by using adminer or phpmyadmin. 

### 1.4 Export routines and triggers separatly
Just in case you need to restore all default triggers and routines later on, please export and save them in sepearte files. Export the triggers and routines is done as follows:

> mysqldump -uroot -p --routines --no-create-info --no-data --no-create-db --skip-opt [schema] > [schema].routines.sql

Repeat this step for all kaltura schemas. 

### 1.5 Register triggers and procedures 
Open the mysql information_schema database in phpmyadmin or adminer. Save or note all records in: information_schema.triggers and information_schema.procedures. This is important because you will be able to check if the system has been succesfully upgraded. 

---

# 2 Setup the upgrade
After installing, verrifying and exporting the healthy kaltura system. We setup the actual upgrade process. 

### 2.2 Stop kaltura services

> service kaltura-monit stop
> service kaltura-batch stop
> service kaltura-sphinx stop

### 2.3 Drop schemas
Drop the following schemas: 

- kaltura
- kalturadw
- kalturadw_bisources
- kalturadw_ds
- kalturalog
- kaltura_sphinx_log

### 2.4 Import production database
Import the production database from a backup, or any other sqldump. After restoration, please verrify that you have the following databases again: 

- kaltura
- kalturadw
- kalturadw_bisources
- kalturadw_ds
- kalturalog
- kaltura_sphinx_log

### 2.5 Import production data
Import the contents of your production servers /opt/kaltura/web to the new server. 

---

# 3 Upgrading
After completing the setup phases. Execute the following steps to start the kaltura upgrade.

###3.1 Create config file
Implement the suplied config.sample.sh as config.sh. Take note:

- Select only the releases that apply to your upgrade. 
- Upgrades are executed in the order you configure them. 
- Configure the root user & password to avoid authentication issues.
- Configure the rest to your own specification.

###3.2 Add the kaltura svn host to the known_hosts file
Execute:

> svn export svn+ssh://svnread@kelev.kaltura.com/usr/local/kalsource/backend/server/tags/falcon_2012_08_20 

You can just cancel after the host has been added.

###3.3 Export releases
Run the following script:

> bin/export.sh

This will build all the releases for upgrading. 

###4.4 Configure releases
Run the follwing script:

> bin/configure.sh

This will supply the required configuration files for all exported releases. 

###4.5 Execute legacy upgrades
Before starting the upgrade run:

> service kaltura-shpinx start

Some updates need sphinx to be running, after all upgrades are completed. We will restore & reindex shpinx later on. 

Run:

> bin/update.sh

This might take anywhere between 1-2 hours depending on how many releases you intend to upgrade. While upgrading you can watch the status by using:

> tail -f [log]

###4.6 Verrify the upgrades
Inspect the run-update log for your upgrade, and inspect errors if they occured. For failed upgrades you will have to inpsect those files and compare them to the results. If a lot of them occured, fix them, and repeat from step 2.4. 

###4.7 Run current kaltura updates
After all legacy upgrades have been completed run the RMP upgrades. 

> /opt/kaltura/bin/kaltura-db-update.sh
And 
> /opt/kaltura/bin/kaltura-config-all.sh

#5 Verrify schema state
After running all upgrades&updates, we need to check the schema for any misses. This is where the backups of the healthy system come in hand. Import the healthy exports into another mysql server.

###5.1 Export schema states
On the healthy system
> mysqldump -uroot -p --routines --no-data kaltura > kaltura.healthy.sql

On the updated system
> mysqldump -uroot -p --routines --no-data kaltura > kaltura.update.sql 

###5.2 Compare and create delta script
Open mysql-workbench, create a new schema and navigate to: database > synchronize with any source. 

As the source select the kaltura.healthy.sql
As the destination select the kaltura.update.sql
Specify the alter script file to your own liking

Continue the wizzard to completion.

###5.3 Inspect delta alter file
Inspect the generated alterscript. Take note that if you have any add column statements, you might have a missed update. Because new fields probably need to be migrated, take extra care inspecting those. 

###5.4 Run the alterscript
Exectute the alter script on the upgraded system. 

###5.5 Repeat
Mysqlworkbench is not perfect. Sometimes you will need to repeat the process until the wizzard no longer finds any differences between healthy and upgraded. 

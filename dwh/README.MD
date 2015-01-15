#DO NOT USE THIS ON A PRODUCTION SERVER! NO WARRANTY
Provided to you by http://www.vixyvideo.nl

###Before you start
You first need to determine what updates were executed on you production environment and remove any scripts that have already been executed.

###Build sources
Before you start, you need to run the following command:
>sh dwh/bin/build-sources.sh

This is because in some SQL scripts partitions are hardcoded to 2011! This in affect will cause the procedures to create a lot of unneeded partitions in the kalturadw table. This script will reset the partition date to, today.

##Updating EAGLE - FALCON (or FALCON - FALCON FINAL)

>php dwh/bin/execute-updates.php [root user] [root password] dwh/sources/falcon/updates

This script takes the longest by far, this is because a lot of partition and storage engine changes take place.

##Updating FALCON - GEMINI
> If updating from FALCON, make sure you are at the FINAL update.

>php dwh/bin/execute-updates.php [root user] [root password] dwh/sources/gemini/updates

There is a major.sql, but this file conflict with the hercules updates.

##Updating GEMINI - HERCULES

>php dwh/bin/execute-updates.php [root user] [root password] dwh/sources/hercules/updates


##Updating HERCULES - IRIS

> mysql -u[root user] -p < dwh/sources/iris/major.sql

After the official upgrade, execute the following extra upgrades

>php dwh/bin/execute-updates.php [root user] [root password] dwh/sources/iris/updates

#Partitioning

If you an error relating to max partition limit reached(1024).

>php dwh/bin/merge-partitions.php [root user] [root pw]

If the falcon update is taking to long, or mysql disk usage is getting out of control. This happened to us because we have a DWH database spanning back to early 2011, this means there are a lot of partitions that are not used.

>php dwh/bin/merge-partitions.php [root user] [root pw]
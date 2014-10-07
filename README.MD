### Prerequisites

#Debian
apt-get install subversion sshpass

#Centos 
yum install svn sshpass 


Connect once to the svn host to save the remote host
svn export svn+ssh://svnread@kelev.kaltura.com/usr/local/kalsource/backend/server/tags/falcon_2012_08_20 
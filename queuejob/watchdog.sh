#!/bin/sh

#获取站点的根目录
cd `dirname $0`/../../;

ret=`ps -ef|grep "queue:work"|grep -v grep|wc -l`
if [ "0" = $ret ];then
  #执行cmd
  nohup php think queue:work --sleep 3 --tries 3 --daemon >> runtime/log/tp-queque.log 2>&1 &
fi
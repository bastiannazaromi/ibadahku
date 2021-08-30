/*
 Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
CKEDITOR.plugins.colordialog={requires:"dialog",lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",init:function(b){var d=new CKEDITOR.dialogCommand("colordialog");d.editorFocus=!1;b.addCommand("colordialog",d);CKEDITOR.dialog.add("colordialog",this.path+"dialogs/colordialog.js");b.getColorFromDialog=function(d,
k,g){var c,e,h,f;c=function(a){h(this);a="ok"==a.name?this.getValueOf("picker","selectedColor"):null;/^[0-9a-f]{3}([0-9a-f]{3})?$/i.test(a)&&(a="#"+a);d.call(k,a)};e=function(a){g&&(a.data=g)};h=function(a){a.removeListener("ok",c);a.removeListener("cancel",c);a.removeListener("show",e)};f=function(a){a.on("ok",c);a.on("cancel",c);a.on("show",e,null,null,5)};b.execCommand("colordialog");if(b._.storedDialogs&&b._.storedDialogs.colordialog)f(b._.storedDialogs.colordialog);else CKEDITOR.on("dialogDefinition",
function(a){if("colordialog"==a.data.name){var b=a.data.definition;a.removeListener();b.onLoad=CKEDITOR.tools.override(b.onLoad,function(a){return function(){f(this);b.onLoad=a;"function"==typeof a&&a.call(this)}})}})}}};CKEDITOR.plugins.add("colordialog",CKEDITOR.plugins.colordialog);
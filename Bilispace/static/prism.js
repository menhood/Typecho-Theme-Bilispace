var _self="undefined"!=typeof window?window:"undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope?self:{},Prism=function(){var b=/\blang(?:uage)?-([\w-]+)\b/i,e=0,c=_self.Prism={manual:_self.Prism&&_self.Prism.manual,disableWorkerMessageHandler:_self.Prism&&_self.Prism.disableWorkerMessageHandler,util:{encode:function(a){return a instanceof k?new k(a.type,c.util.encode(a.content),a.alias):"Array"===c.util.type(a)?a.map(c.util.encode):a.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/\u00a0/g,
" ")},type:function(a){return Object.prototype.toString.call(a).slice(8,-1)},objId:function(a){return a.__id||Object.defineProperty(a,"__id",{value:++e}),a.__id},clone:function(a,d){var g=c.util.type(a);switch(d=d||{},g){case "Object":if(d[c.util.objId(a)])return d[c.util.objId(a)];var f={};d[c.util.objId(a)]=f;for(var b in a)a.hasOwnProperty(b)&&(f[b]=c.util.clone(a[b],d));return f;case "Array":if(d[c.util.objId(a)])return d[c.util.objId(a)];f=[];return d[c.util.objId(a)]=f,a.forEach(function(a,
g){f[g]=c.util.clone(a,d)}),f}return a}},languages:{extend:function(a,d){a=c.util.clone(c.languages[a]);for(var g in d)a[g]=d[g];return a},insertBefore:function(a,d,g,f){f=f||c.languages;var b=f[a],k={},e;for(e in b)if(b.hasOwnProperty(e)){if(e==d)for(var h in g)g.hasOwnProperty(h)&&(k[h]=g[h]);g.hasOwnProperty(e)||(k[e]=b[e])}var A=f[a];return f[a]=k,c.languages.DFS(c.languages,function(d,c){c===A&&d!=a&&(this[d]=k)}),k},DFS:function(a,d,g,f){f=f||{};for(var b in a)a.hasOwnProperty(b)&&(d.call(a,
b,a[b],g||b),"Object"!==c.util.type(a[b])||f[c.util.objId(a[b])]?"Array"!==c.util.type(a[b])||f[c.util.objId(a[b])]||(f[c.util.objId(a[b])]=!0,c.languages.DFS(a[b],d,b,f)):(f[c.util.objId(a[b])]=!0,c.languages.DFS(a[b],d,null,f)))}},plugins:{},highlightAll:function(a,d){c.highlightAllUnder(document,a,d)},highlightAllUnder:function(a,d,b){b={callback:b,selector:'code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code'};c.hooks.run("before-highlightall",b);for(var g=
b.elements||a.querySelectorAll(b.selector),k=0;a=g[k++];)c.highlightElement(a,!0===d,b.callback)},highlightElement:function(a,d,g){for(var f,k,e=a;e&&!b.test(e.className);)e=e.parentNode;e&&(f=(e.className.match(b)||[,""])[1].toLowerCase(),k=c.languages[f]);a.className=a.className.replace(b,"").replace(/\s+/g," ")+" language-"+f;a.parentNode&&(e=a.parentNode,/pre/i.test(e.nodeName)&&(e.className=e.className.replace(b,"").replace(/\s+/g," ")+" language-"+f));var h={element:a,language:f,grammar:k,code:a.textContent},
r=function(a){h.highlightedCode=a;c.hooks.run("before-insert",h);h.element.innerHTML=h.highlightedCode;c.hooks.run("after-highlight",h);c.hooks.run("complete",h);g&&g.call(h.element)};if(c.hooks.run("before-sanity-check",h),!h.code)return c.hooks.run("complete",h),void 0;if(c.hooks.run("before-highlight",h),!h.grammar)return r(c.util.encode(h.code)),void 0;d&&_self.Worker?(a=new Worker(c.filename),a.onmessage=function(a){r(a.data)},a.postMessage(JSON.stringify({language:h.language,code:h.code,immediateClose:!0}))):
r(c.highlight(h.code,h.grammar,h.language))},highlight:function(a,d,b){a={code:a,grammar:d,language:b};return c.hooks.run("before-tokenize",a),a.tokens=c.tokenize(a.code,a.grammar),c.hooks.run("after-tokenize",a),k.stringify(c.util.encode(a.tokens),a.language)},matchGrammar:function(a,d,b,f,e,k,h){var g=c.Token,p;for(p in b)if(b.hasOwnProperty(p)&&b[p]){if(p==h)break;var y=b[p];y="Array"===c.util.type(y)?y:[y];for(var w=0;w<y.length;++w){var n=y[w],x=n.inside,D=!!n.lookbehind,B=!!n.greedy,C=0,E=n.alias;
if(B&&!n.pattern.global){var q=n.pattern.toString().match(/[imuy]*$/)[0];n.pattern=RegExp(n.pattern.source,q+"g")}n=n.pattern||n;q=f;for(var u=e;q<d.length;u+=d[q].length,++q){var m=d[q];if(d.length>a.length)return;if(!(m instanceof g)){if(B&&q!=d.length-1){n.lastIndex=u;var l=n.exec(a);if(!l)break;var v=l.index+(D?l[1].length:0),z=l.index+l[0].length,t=q;m=u;for(var F=d.length;F>t&&(z>m||!d[t].type&&!d[t-1].greedy);++t)m+=d[t].length,v>=m&&(++q,u=m);if(d[q]instanceof g)continue;t-=q;m=a.slice(u,
m);l.index-=u}else n.lastIndex=0,l=n.exec(m),t=1;if(l){if(D&&(C=l[1]?l[1].length:0),v=l.index+C,l=l[0].slice(C),z=v+l.length,v=m.slice(0,v),z=m.slice(z),m=[q,t],v&&(++q,u+=v.length,m.push(v)),l=new g(p,x?c.tokenize(l,x):l,E,l,B),m.push(l),z&&m.push(z),Array.prototype.splice.apply(d,m),1!=t&&c.matchGrammar(a,d,b,q,u,!0,p),k)break}else if(k)break}}}}},tokenize:function(a,d){var b=[a],f=d.rest;if(f){for(var e in f)d[e]=f[e];delete d.rest}return c.matchGrammar(a,b,d,0,0,!1),b},hooks:{all:{},add:function(a,
d){var b=c.hooks.all;b[a]=b[a]||[];b[a].push(d)},run:function(a,b){if((a=c.hooks.all[a])&&a.length)for(var d,f=0;d=a[f++];)d(b)}}},k=c.Token=function(a,b,c,f,e){this.type=a;this.content=b;this.alias=c;this.length=0|(f||"").length;this.greedy=!!e};if(k.stringify=function(a,b,e){if("string"==typeof a)return a;if("Array"===c.util.type(a))return a.map(function(d){return k.stringify(d,b,a)}).join("");var d={type:a.type,content:k.stringify(a.content,b,e),tag:"span",classes:["token",a.type],attributes:{},
language:b,parent:e};a.alias&&(e="Array"===c.util.type(a.alias)?a.alias:[a.alias],Array.prototype.push.apply(d.classes,e));c.hooks.run("wrap",d);e=Object.keys(d.attributes).map(function(a){return a+'="'+(d.attributes[a]||"").replace(/"/g,"&quot;")+'"'}).join(" ");return"<"+d.tag+' class="'+d.classes.join(" ")+'"'+(e?" "+e:"")+">"+d.content+"</"+d.tag+">"},!_self.document)return _self.addEventListener?(c.disableWorkerMessageHandler||_self.addEventListener("message",function(a){a=JSON.parse(a.data);
var b=a.language,e=a.immediateClose;_self.postMessage(c.highlight(a.code,c.languages[b],b));e&&_self.close()},!1),_self.Prism):_self.Prism;var h=document.currentScript||[].slice.call(document.getElementsByTagName("script")).pop();return h&&(c.filename=h.src,c.manual||h.hasAttribute("data-manual")||("loading"!==document.readyState?window.requestAnimationFrame?window.requestAnimationFrame(c.highlightAll):window.setTimeout(c.highlightAll,16):document.addEventListener("DOMContentLoaded",c.highlightAll))),
_self.Prism}();"undefined"!=typeof module&&module.exports&&(module.exports=Prism);"undefined"!=typeof global&&(global.Prism=Prism);
Prism.languages.markup={comment:/\x3c!--[\s\S]*?--\x3e/,prolog:/<\?[\s\S]+?\?>/,doctype:/<!DOCTYPE[\s\S]+?>/i,cdata:/<!\[CDATA\[[\s\S]*?]]\x3e/i,tag:{pattern:/<\/?(?!\d)[^\s>\/=$<%]+(?:\s+[^\s>\/=]+(?:=(?:("|')(?:\\[\s\S]|(?!\1)[^\\])*\1|[^\s'">=]+))?)*\s*\/?>/i,greedy:!0,inside:{tag:{pattern:/^<\/?[^\s>\/]+/i,inside:{punctuation:/^<\/?/,namespace:/^[^\s>\/:]+:/}},"attr-value":{pattern:/=(?:("|')(?:\\[\s\S]|(?!\1)[^\\])*\1|[^\s'">=]+)/i,inside:{punctuation:[/^=/,{pattern:/(^|[^\\])["']/,lookbehind:!0}]}},
punctuation:/\/?>/,"attr-name":{pattern:/[^\s>\/]+/,inside:{namespace:/^[^\s>\/:]+:/}}}},entity:/&#?[\da-z]{1,8};/i};Prism.languages.markup.tag.inside["attr-value"].inside.entity=Prism.languages.markup.entity;Prism.hooks.add("wrap",function(b){"entity"===b.type&&(b.attributes.title=b.content.replace(/&amp;/,"&"))});Prism.languages.xml=Prism.languages.extend("markup",{});Prism.languages.html=Prism.languages.markup;Prism.languages.mathml=Prism.languages.markup;Prism.languages.svg=Prism.languages.markup;
Prism.languages.css={comment:/\/\*[\s\S]*?\*\//,atrule:{pattern:/@[\w-]+?[\s\S]*?(?:;|(?=\s*\{))/i,inside:{rule:/@[\w-]+/}},url:/url\((?:(["'])(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1|.*?)\)/i,selector:/[^{}\s][^{};]*?(?=\s*\{)/,string:{pattern:/("|')(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,greedy:!0},property:/[-_a-z\xA0-\uFFFF][-\w\xA0-\uFFFF]*(?=\s*:)/i,important:/!important\b/i,"function":/[-a-z0-9]+(?=\()/i,punctuation:/[(){};:,]/};Prism.languages.css.atrule.inside.rest=Prism.languages.css;
Prism.languages.markup&&(Prism.languages.insertBefore("markup","tag",{style:{pattern:/(<style[\s\S]*?>)[\s\S]*?(?=<\/style>)/i,lookbehind:!0,inside:Prism.languages.css,alias:"language-css",greedy:!0}}),Prism.languages.insertBefore("inside","attr-value",{"style-attr":{pattern:/\s*style=("|')(?:\\[\s\S]|(?!\1)[^\\])*\1/i,inside:{"attr-name":{pattern:/^\s*style/i,inside:Prism.languages.markup.tag.inside},punctuation:/^\s*=\s*['"]|['"]\s*$/,"attr-value":{pattern:/.+/i,inside:Prism.languages.css}},alias:"language-css"}},
Prism.languages.markup.tag));
Prism.languages.clike={comment:[{pattern:/(^|[^\\])\/\*[\s\S]*?(?:\*\/|$)/,lookbehind:!0},{pattern:/(^|[^\\:])\/\/.*/,lookbehind:!0,greedy:!0}],string:{pattern:/(["'])(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,greedy:!0},"class-name":{pattern:/((?:\b(?:class|interface|extends|implements|trait|instanceof|new)\s+)|(?:catch\s+\())[\w.\\]+/i,lookbehind:!0,inside:{punctuation:/[.\\]/}},keyword:/\b(?:if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/,"boolean":/\b(?:true|false)\b/,
"function":/\w+(?=\()/,number:/\b0x[\da-f]+\b|(?:\b\d+\.?\d*|\B\.\d+)(?:e[+-]?\d+)?/i,operator:/--?|\+\+?|!=?=?|<=?|>=?|==?=?|&&?|\|\|?|\?|\*|\/|~|\^|%/,punctuation:/[{}[\];(),.:]/};
Prism.languages.javascript=Prism.languages.extend("clike",{"class-name":[Prism.languages.clike["class-name"],{pattern:/(^|[^$\w\xA0-\uFFFF])[_$A-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\.(?:prototype|constructor))/,lookbehind:!0}],keyword:[{pattern:/((?:^|})\s*)(?:catch|finally)\b/,lookbehind:!0},/\b(?:as|async|await|break|case|class|const|continue|debugger|default|delete|do|else|enum|export|extends|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)\b/],number:/\b(?:(?:0[xX][\dA-Fa-f]+|0[bB][01]+|0[oO][0-7]+)n?|\d+n|NaN|Infinity)\b|(?:\b\d+\.?\d*|\B\.\d+)(?:[Ee][+-]?\d+)?/,
"function":/[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*\(|\.(?:apply|bind|call)\()/,operator:/-[-=]?|\+[+=]?|!=?=?|<<?=?|>>?>?=?|=(?:==?|>)?|&[&=]?|\|[|=]?|\*\*?=?|\/=?|~|\^=?|%=?|\?|\.{3}/});Prism.languages.javascript["class-name"][0].pattern=/(\b(?:class|interface|extends|implements|instanceof|new)\s+)[\w.\\]+/;
Prism.languages.insertBefore("javascript","keyword",{regex:{pattern:/((?:^|[^$\w\xA0-\uFFFF."'\])\s])\s*)\/(\[(?:[^\]\\\r\n]|\\.)*]|\\.|[^\/\\\[\r\n])+\/[gimyu]{0,5}(?=\s*($|[\r\n,.;})\]]))/,lookbehind:!0,greedy:!0},"function-variable":{pattern:/[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*[=:]\s*(?:async\s*)?(?:\bfunction\b|(?:\((?:[^()]|\([^()]*\))*\)|[_$a-zA-Z\xA0-\uFFFF][$\w\xA0-\uFFFF]*)\s*=>))/,alias:"function"},parameter:[{pattern:/(function(?:\s+[_$A-Za-z\xA0-\uFFFF][$\w\xA0-\uFFFF]*)?\s*\(\s*)(?!\s)(?:[^()]|\([^()]*\))+?(?=\s*\))/,
lookbehind:!0,inside:Prism.languages.javascript},{pattern:/[_$a-z\xA0-\uFFFF][$\w\xA0-\uFFFF]*(?=\s*=>)/i,inside:Prism.languages.javascript},{pattern:/(\(\s*)(?!\s)(?:[^()]|\([^()]*\))+?(?=\s*\)\s*=>)/,lookbehind:!0,inside:Prism.languages.javascript},{pattern:/((?:\b|\s|^)(?!(?:as|async|await|break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)(?![$\w\xA0-\uFFFF]))(?:[_$A-Za-z\xA0-\uFFFF][$\w\xA0-\uFFFF]*\s*)\(\s*)(?!\s)(?:[^()]|\([^()]*\))+?(?=\s*\)\s*\{)/,
lookbehind:!0,inside:Prism.languages.javascript}],constant:/\b[A-Z][A-Z\d_]*\b/});Prism.languages.insertBefore("javascript","string",{"template-string":{pattern:/`(?:\\[\s\S]|\${[^}]+}|[^\\`])*`/,greedy:!0,inside:{interpolation:{pattern:/\${[^}]+}/,inside:{"interpolation-punctuation":{pattern:/^\${|}$/,alias:"punctuation"},rest:Prism.languages.javascript}},string:/[\s\S]+/}}});
Prism.languages.markup&&Prism.languages.insertBefore("markup","tag",{script:{pattern:/(<script[\s\S]*?>)[\s\S]*?(?=<\/script>)/i,lookbehind:!0,inside:Prism.languages.javascript,alias:"language-javascript",greedy:!0}});Prism.languages.js=Prism.languages.javascript;
!function(b){var e={variable:[{pattern:/\$?\(\([\s\S]+?\)\)/,inside:{variable:[{pattern:/(^\$\(\([\s\S]+)\)\)/,lookbehind:!0},/^\$\(\(/],number:/\b0x[\dA-Fa-f]+\b|(?:\b\d+\.?\d*|\B\.\d+)(?:[Ee]-?\d+)?/,operator:/--?|-=|\+\+?|\+=|!=?|~|\*\*?|\*=|\/=?|%=?|<<=?|>>=?|<=?|>=?|==?|&&?|&=|\^=?|\|\|?|\|=|\?|:/,punctuation:/\(\(?|\)\)?|,|;/}},{pattern:/\$\([^)]+\)|`[^`]+`/,greedy:!0,inside:{variable:/^\$\(|^`|\)$|`$/}},/\$(?:[\w#?*!@]+|\{[^}]+\})/i]};b.languages.bash={shebang:{pattern:/^#!\s*\/bin\/bash|^#!\s*\/bin\/sh/,
alias:"important"},comment:{pattern:/(^|[^"{\\])#.*/,lookbehind:!0},string:[{pattern:/((?:^|[^<])<<\s*)["']?(\w+?)["']?\s*\r?\n(?:[\s\S])*?\r?\n\2/,lookbehind:!0,greedy:!0,inside:e},{pattern:/(["'])(?:\\[\s\S]|\$\([^)]+\)|`[^`]+`|(?!\1)[^\\])*\1/,greedy:!0,inside:e}],variable:e.variable,"function":{pattern:/(^|[\s;|&])(?:add|alias|apropos|apt|apt-cache|apt-get|aptitude|aspell|automysqlbackup|awk|basename|bash|bc|bconsole|bg|builtin|bzip2|cal|cat|cd|cfdisk|chgrp|chkconfig|chmod|chown|chroot|cksum|clear|cmp|comm|command|cp|cron|crontab|csplit|curl|cut|date|dc|dd|ddrescue|debootstrap|df|diff|diff3|dig|dir|dircolors|dirname|dirs|dmesg|du|egrep|eject|enable|env|ethtool|eval|exec|expand|expect|export|expr|fdformat|fdisk|fg|fgrep|file|find|fmt|fold|format|free|fsck|ftp|fuser|gawk|getopts|git|gparted|grep|groupadd|groupdel|groupmod|groups|grub-mkconfig|gzip|halt|hash|head|help|hg|history|host|hostname|htop|iconv|id|ifconfig|ifdown|ifup|import|install|ip|jobs|join|kill|killall|less|link|ln|locate|logname|logout|logrotate|look|lpc|lpr|lprint|lprintd|lprintq|lprm|ls|lsof|lynx|make|man|mc|mdadm|mkconfig|mkdir|mke2fs|mkfifo|mkfs|mkisofs|mknod|mkswap|mmv|more|most|mount|mtools|mtr|mutt|mv|nano|nc|netstat|nice|nl|nohup|notify-send|npm|nslookup|op|open|parted|passwd|paste|pathchk|ping|pkill|pnpm|popd|pr|printcap|printenv|printf|ps|pushd|pv|pwd|quota|quotacheck|quotactl|ram|rar|rcp|read|readarray|readonly|reboot|remsync|rename|renice|rev|rm|rmdir|rpm|rsync|scp|screen|sdiff|sed|sendmail|seq|service|sftp|shift|shopt|shutdown|sleep|slocate|sort|source|split|ssh|stat|strace|su|sudo|sum|suspend|swapon|sync|tail|tar|tee|test|time|timeout|times|top|touch|tr|traceroute|trap|tsort|tty|type|ulimit|umask|umount|unalias|uname|unexpand|uniq|units|unrar|unshar|unzip|update-grub|uptime|useradd|userdel|usermod|users|uudecode|uuencode|vdir|vi|vim|virsh|vmstat|wait|watch|wc|wget|whereis|which|who|whoami|write|xargs|xdg-open|yarn|yes|zip|zypper)(?=$|[\s;|&])/,
lookbehind:!0},keyword:{pattern:/(^|[\s;|&])(?:let|:|\.|if|then|else|elif|fi|for|break|continue|while|in|case|function|select|do|done|until|echo|exit|return|set|declare)(?=$|[\s;|&])/,lookbehind:!0},"boolean":{pattern:/(^|[\s;|&])(?:true|false)(?=$|[\s;|&])/,lookbehind:!0},operator:/&&?|\|\|?|==?|!=?|<<<?|>>|<=?|>=?|=~/,punctuation:/\$?\(\(?|\)\)?|\.\.|[{}[\];]/};e=e.variable[1].inside;e.string=b.languages.bash.string;e["function"]=b.languages.bash["function"];e.keyword=b.languages.bash.keyword;e["boolean"]=
b.languages.bash["boolean"];e.operator=b.languages.bash.operator;e.punctuation=b.languages.bash.punctuation;b.languages.shell=b.languages.bash}(Prism);Prism.languages["markup-templating"]={};
Object.defineProperties(Prism.languages["markup-templating"],{buildPlaceholders:{value:function(b,e,c,k){b.language===e&&(b.tokenStack=[],b.code=b.code.replace(c,function(c){if("function"==typeof k&&!k(c))return c;for(var a=b.tokenStack.length;-1!==b.code.indexOf("___"+e.toUpperCase()+a+"___");)++a;return b.tokenStack[a]=c,"___"+e.toUpperCase()+a+"___"}),b.grammar=Prism.languages.markup)}},tokenizePlaceholders:{value:function(b,e){if(b.language===e&&b.tokenStack){b.grammar=Prism.languages[e];var c=
0,k=Object.keys(b.tokenStack),h=function(a){if(!(c>=k.length))for(var d=0;d<a.length;d++){var g=a[d];if("string"==typeof g||g.content&&"string"==typeof g.content){var f=k[c],p=b.tokenStack[f],w="string"==typeof g?g:g.content,x=w.indexOf("___"+e.toUpperCase()+f+"___");if(-1<x){++c;var r,A=w.substring(0,x);p=new Prism.Token(e,Prism.tokenize(p,b.grammar,e),"language-"+e,p);f=w.substring(x+("___"+e.toUpperCase()+f+"___").length);if(A||f?(r=[A,p,f].filter(function(a){return!!a}),h(r)):r=p,"string"==typeof g?
Array.prototype.splice.apply(a,[d,1].concat(r)):g.content=r,c>=k.length)break}}else g.content&&"string"!=typeof g.content&&h(g.content)}};h(b.tokens)}}}});Prism.languages.json={comment:/\/\/.*|\/\*[\s\S]*?(?:\*\/|$)/,property:{pattern:/"(?:\\.|[^\\"\r\n])*"(?=\s*:)/,greedy:!0},string:{pattern:/"(?:\\.|[^\\"\r\n])*"(?!\s*:)/,greedy:!0},number:/-?\d+\.?\d*(e[+-]?\d+)?/i,punctuation:/[{}[\],]/,operator:/:/,"boolean":/\b(?:true|false)\b/,"null":{pattern:/\bnull\b/,alias:"keyword"}};
Prism.languages.jsonp=Prism.languages.json;
!function(b){b.languages.php=b.languages.extend("clike",{keyword:/\b(?:__halt_compiler|abstract|and|array|as|break|callable|case|catch|class|clone|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|eval|exit|extends|final|finally|for|foreach|function|global|goto|if|implements|include|include_once|instanceof|insteadof|interface|isset|list|namespace|new|or|parent|print|private|protected|public|require|require_once|return|static|switch|throw|trait|try|unset|use|var|while|xor|yield)\b/i,"boolean":{pattern:/\b(?:false|true)\b/i,
alias:"constant"},constant:[/\b[A-Z_][A-Z0-9_]*\b/,/\b(?:null)\b/i],comment:{pattern:/(^|[^\\])(?:\/\*[\s\S]*?\*\/|\/\/.*)/,lookbehind:!0}});b.languages.insertBefore("php","string",{"shell-comment":{pattern:/(^|[^\\])#.*/,lookbehind:!0,alias:"comment"}});b.languages.insertBefore("php","keyword",{delimiter:{pattern:/\?>|<\?(?:php|=)?/i,alias:"important"},variable:/\$+(?:\w+\b|(?={))/i,"package":{pattern:/(\\|namespace\s+|use\s+)[\w\\]+/,lookbehind:!0,inside:{punctuation:/\\/}}});b.languages.insertBefore("php",
"operator",{property:{pattern:/(->)[\w]+/,lookbehind:!0}});var e={pattern:/{\$(?:{(?:{[^{}]+}|[^{}]+)}|[^{}])+}|(^|[^\\{])\$+(?:\w+(?:\[.+?]|->\w+)*)/,lookbehind:!0,inside:{rest:b.languages.php}};b.languages.insertBefore("php","string",{"nowdoc-string":{pattern:/<<<'([^']+)'(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\1;/,greedy:!0,alias:"string",inside:{delimiter:{pattern:/^<<<'[^']+'|[a-z_]\w*;$/i,alias:"symbol",inside:{punctuation:/^<<<'?|[';]$/}}}},"heredoc-string":{pattern:/<<<(?:"([^"]+)"(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\1;|([a-z_]\w*)(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\2;)/i,
greedy:!0,alias:"string",inside:{delimiter:{pattern:/^<<<(?:"[^"]+"|[a-z_]\w*)|[a-z_]\w*;$/i,alias:"symbol",inside:{punctuation:/^<<<"?|[";]$/}},interpolation:e}},"single-quoted-string":{pattern:/'(?:\\[\s\S]|[^\\'])*'/,greedy:!0,alias:"string"},"double-quoted-string":{pattern:/"(?:\\[\s\S]|[^\\"])*"/,greedy:!0,alias:"string",inside:{interpolation:e}}});delete b.languages.php.string;b.hooks.add("before-tokenize",function(c){/(?:<\?php|<\?)/gi.test(c.code)&&b.languages["markup-templating"].buildPlaceholders(c,
"php",/(?:<\?php|<\?)[\s\S]*?(?:\?>|$)/gi)});b.hooks.add("after-tokenize",function(c){b.languages["markup-templating"].tokenizePlaceholders(c,"php")})}(Prism);
!function(){if("undefined"!=typeof self&&self.Prism&&self.document){var b=/\n(?!$)/g,e=function(e){var k=c(e)["white-space"];if("pre-wrap"===k||"pre-line"===k){k=e.querySelector("code");var a=e.querySelector(".line-numbers-rows"),d=e.querySelector(".line-numbers-sizer");e=k.textContent.split(b);d||(d=document.createElement("span"),d.className="line-numbers-sizer",k.appendChild(d));d.style.display="block";e.forEach(function(b,c){d.textContent=b||"\n";b=d.getBoundingClientRect().height;a.children[c].style.height=
b+"px"});d.textContent="";d.style.display="none"}},c=function(b){return b?window.getComputedStyle?getComputedStyle(b):b.currentStyle||null:null};window.addEventListener("resize",function(){Array.prototype.forEach.call(document.querySelectorAll("pre.line-numbers"),e)});Prism.hooks.add("complete",function(c){if(c.code){var h=c.element.parentNode,a=/\s*\bline-numbers\b\s*/;if(h&&/pre/i.test(h.nodeName)&&(a.test(h.className)||a.test(c.element.className))&&!c.element.querySelector(".line-numbers-rows")){a.test(c.element.className)&&
(c.element.className=c.element.className.replace(a," "));a.test(h.className)||(h.className+=" line-numbers");a=c.code.match(b);var d=Array((a?a.length+1:1)+1);d=d.join("<span></span>");a=document.createElement("span");a.setAttribute("aria-hidden","true");a.className="line-numbers-rows";a.innerHTML=d;h.hasAttribute("data-start")&&(h.style.counterReset="linenumber "+(parseInt(h.getAttribute("data-start"),10)-1));c.element.appendChild(a);e(h);Prism.hooks.run("line-numbers",c)}}});Prism.hooks.add("line-numbers",
function(b){b.plugins=b.plugins||{};b.plugins.lineNumbers=!0});Prism.plugins.lineNumbers={getLine:function(b,c){if("PRE"===b.tagName&&b.classList.contains("line-numbers")){var a=b.querySelector(".line-numbers-rows");b=parseInt(b.getAttribute("data-start"),10)||1;var d=b+(a.children.length-1);b>c&&(c=b);c>d&&(c=d);return a.children[c-b]}}}}}();
!function(){if("undefined"!=typeof self&&self.Prism&&self.document){var b=[],e={},c=function(){};Prism.plugins.toolbar={};var k=Prism.plugins.toolbar.registerButton=function(a,c){b.push(e[a]="function"==typeof c?c:function(a){var b;return"function"==typeof c.onClick?(b=document.createElement("button"),b.type="button",b.addEventListener("click",function(){c.onClick.call(this,a)})):"string"==typeof c.url?(b=document.createElement("a"),b.href=c.url):b=document.createElement("span"),b.textContent=c.text,
b})},h=Prism.plugins.toolbar.hook=function(a){var d=a.element.parentNode;if(d&&/pre/i.test(d.nodeName)&&!d.parentNode.classList.contains("code-toolbar")){var g=document.createElement("div");g.classList.add("code-toolbar");d.parentNode.insertBefore(g,d);g.appendChild(d);var f=document.createElement("div");f.classList.add("toolbar");document.body.hasAttribute("data-toolbar-order")&&(b=document.body.getAttribute("data-toolbar-order").split(",").map(function(a){return e[a]||c}));b.forEach(function(b){if(b=
b(a)){var c=document.createElement("div");c.classList.add("toolbar-item");c.appendChild(b);f.appendChild(c)}});g.appendChild(f)}};k("label",function(a){if((a=a.element.parentNode)&&/pre/i.test(a.nodeName)&&a.hasAttribute("data-label")){var b,c=a.getAttribute("data-label");try{var e=document.querySelector("template#"+c)}catch(p){}return e?b=e.content:(a.hasAttribute("data-url")?(b=document.createElement("a"),b.href=a.getAttribute("data-url")):b=document.createElement("span"),b.textContent=c),b}});
Prism.hooks.add("complete",h)}}();
!function(){if("undefined"!=typeof self&&self.Prism&&self.document){if(!Prism.plugins.toolbar)return console.warn("Show Languages plugin loaded before Toolbar plugin."),void 0;var b={html:"HTML",xml:"XML",svg:"SVG",mathml:"MathML",css:"CSS",clike:"C-like",js:"JavaScript",abap:"ABAP",apacheconf:"Apache Configuration",apl:"APL",arff:"ARFF",asciidoc:"AsciiDoc",adoc:"AsciiDoc",asm6502:"6502 Assembly",aspnet:"ASP.NET (C#)",autohotkey:"AutoHotkey",autoit:"AutoIt",shell:"Bash",basic:"BASIC",csharp:"C#",
dotnet:"C#",cpp:"C++",cil:"CIL",csp:"Content-Security-Policy","css-extras":"CSS Extras",django:"Django/Jinja2",jinja2:"Django/Jinja2",dockerfile:"Docker",erb:"ERB",fsharp:"F#",gcode:"G-code",gedcom:"GEDCOM",glsl:"GLSL",gml:"GameMaker Language",gamemakerlanguage:"GameMaker Language",graphql:"GraphQL",hcl:"HCL",http:"HTTP",hpkp:"HTTP Public-Key-Pins",hsts:"HTTP Strict-Transport-Security",ichigojam:"IchigoJam",inform7:"Inform 7",javastacktrace:"Java stack trace",json:"JSON",jsonp:"JSONP",latex:"LaTeX",
emacs:"Lisp",elisp:"Lisp","emacs-lisp":"Lisp",lolcode:"LOLCODE","markup-templating":"Markup templating",matlab:"MATLAB",mel:"MEL",n1ql:"N1QL",n4js:"N4JS",n4jsd:"N4JS","nand2tetris-hdl":"Nand To Tetris HDL",nasm:"NASM",nginx:"nginx",nsis:"NSIS",objectivec:"Objective-C",ocaml:"OCaml",opencl:"OpenCL",parigp:"PARI/GP",objectpascal:"Object Pascal",php:"PHP","php-extras":"PHP Extras",plsql:"PL/SQL",powershell:"PowerShell",properties:".properties",protobuf:"Protocol Buffers",q:"Q (kdb+ database)",jsx:"React JSX",
tsx:"React TSX",renpy:"Ren'py",rest:"reST (reStructuredText)",sas:"SAS",sass:"Sass (Sass)",scss:"Sass (Scss)",sql:"SQL",soy:"Soy (Closure Template)",tap:"TAP",toml:"TOML",tt2:"Template Toolkit 2",ts:"TypeScript",vbnet:"VB.Net",vhdl:"VHDL",vim:"vim","visual-basic":"Visual Basic",vb:"Visual Basic",wasm:"WebAssembly",wiki:"Wiki markup",xeoracube:"XeoraCube",xojo:"Xojo (REALbasic)",xquery:"XQuery",yaml:"YAML"};Prism.plugins.toolbar.registerButton("show-language",function(e){var c=e.element.parentNode;
if(c&&/pre/i.test(c.nodeName)&&((c=c.getAttribute("data-language")||b[e.language])||(c=(e=e.language)?(e.substring(0,1).toUpperCase()+e.substring(1)).replace(/s(?=cript)/,"S"):e),e=c))return c=document.createElement("span"),c.textContent=e,c})}}();
!function(){if("undefined"!=typeof self&&self.Prism&&self.document){if(!Prism.plugins.toolbar)return console.warn("Copy to Clipboard plugin loaded before Toolbar plugin."),void 0;var b=window.ClipboardJS||void 0;b||"function"!=typeof require||(b=require("clipboard"));var e=[];if(!b){var c=document.createElement("script"),k=document.querySelector("head");c.onload=function(){if(b=window.ClipboardJS)for(;e.length;)e.pop()()};c.src="https://cdnjs.loli.net/ajax/libs/clipboard.js/2.0.0/clipboard.min.js";
k.appendChild(c)}Prism.plugins.toolbar.registerButton("copy-to-clipboard",function(c){function a(){var a=new b(g,{text:function(){return c.code}});a.on("success",function(){g.textContent="Copied!";d()});a.on("error",function(){g.textContent="Press Ctrl+C to copy";d()})}function d(){setTimeout(function(){g.textContent="Copy"},5E3)}var g=document.createElement("a");return g.textContent="Copy",b?a():e.push(a),g})}}();
(function(){var t,e=[].indexOf||function(t){for(var e=0,n=this.length;n>e;e++)if(e in this&&this[e]===t)return e;return-1},n=[].slice,r=function(t,e){return function(){return t.apply(e,arguments)}},a={}.hasOwnProperty;(t=function(t){return"object"==typeof exports&&"object"==typeof module?t(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)})(function(t){var o,i,s,l,u,c,h,d,p,f,m,g,v,b,C,y,w,A,x,S,N;return i=function(t,e,n){var r,a,o,i;for(t+="",a=t.split("."),o=a[0],i=a.length>1?n+a[1]:"",r=/(\d+)(\d{3})/;r.test(o);)o=o.replace(r,"$1"+e+"$2");return o+i},m=function(e){var n;return n={digitsAfterDecimal:2,scaler:1,thousandsSep:",",decimalSep:".",prefix:"",suffix:"",showZero:!1},e=t.extend({},n,e),function(t){var n;return isNaN(t)||!isFinite(t)?"":0!==t||e.showZero?(n=i((e.scaler*t).toFixed(e.digitsAfterDecimal),e.thousandsSep,e.decimalSep),""+e.prefix+n+e.suffix):""}},A=m(),x=m({digitsAfterDecimal:0}),S=m({digitsAfterDecimal:1,scaler:100,suffix:"%"}),s={count:function(t){return null==t&&(t=x),function(){return function(e,n,r){return{count:0,push:function(){return this.count++},value:function(){return this.count},format:t}}}},uniques:function(t,n){return null==n&&(n=x),function(r){var a;return a=r[0],function(r,o,i){return{uniq:[],push:function(t){var n;return n=t[a],e.call(this.uniq,n)<0?this.uniq.push(t[a]):void 0},value:function(){return t(this.uniq)},format:n,numInputs:null!=a?0:1}}}},sum:function(t){return null==t&&(t=A),function(e){var n;return n=e[0],function(e,r,a){return{sum:0,push:function(t){return isNaN(parseFloat(t[n]))?void 0:this.sum+=parseFloat(t[n])},value:function(){return this.sum},format:t,numInputs:null!=n?0:1}}}},extremes:function(t,e){return null==e&&(e=A),function(n){var r;return r=n[0],function(n,a,o){return{val:null,sorter:h(null!=n?n.sorters:void 0,r),push:function(e){var n,a,o,i;return i=e[r],("min"===t||"max"===t)&&(i=parseFloat(i),isNaN(i)||(this.val=Math[t](i,null!=(n=this.val)?n:i))),"first"===t&&this.sorter(i,null!=(a=this.val)?a:i)<=0&&(this.val=i),"last"===t&&this.sorter(i,null!=(o=this.val)?o:i)>=0?this.val=i:void 0},value:function(){return this.val},format:function(t){return isNaN(t)?t:e(t)},numInputs:null!=r?0:1}}}},quantile:function(t,e){return null==e&&(e=A),function(n){var r;return r=n[0],function(n,a,o){return{vals:[],push:function(t){var e;return e=parseFloat(t[r]),isNaN(e)?void 0:this.vals.push(e)},value:function(){var e;return 0===this.vals.length?null:(this.vals.sort(function(t,e){return t-e}),e=(this.vals.length-1)*t,(this.vals[Math.floor(e)]+this.vals[Math.ceil(e)])/2)},format:e,numInputs:null!=r?0:1}}}},runningStat:function(t,e,n){return null==t&&(t="mean"),null==e&&(e=1),null==n&&(n=A),function(r){var a;return a=r[0],function(r,o,i){return{n:0,m:0,s:0,push:function(t){var e,n;return n=parseFloat(t[a]),isNaN(n)?void 0:(this.n+=1,1===this.n?this.m=n:(e=this.m+(n-this.m)/this.n,this.s=this.s+(n-this.m)*(n-e),this.m=e))},value:function(){if("mean"===t)return 0===this.n?0/0:this.m;if(this.n<=e)return 0;switch(t){case"var":return this.s/(this.n-e);case"stdev":return Math.sqrt(this.s/(this.n-e))}},format:n,numInputs:null!=a?0:1}}}},sumOverSum:function(t){return null==t&&(t=A),function(e){var n,r;return r=e[0],n=e[1],function(e,a,o){return{sumNum:0,sumDenom:0,push:function(t){return isNaN(parseFloat(t[r]))||(this.sumNum+=parseFloat(t[r])),isNaN(parseFloat(t[n]))?void 0:this.sumDenom+=parseFloat(t[n])},value:function(){return this.sumNum/this.sumDenom},format:t,numInputs:null!=r&&null!=n?0:2}}}},sumOverSumBound80:function(t,e){return null==t&&(t=!0),null==e&&(e=A),function(n){var r,a;return a=n[0],r=n[1],function(n,o,i){return{sumNum:0,sumDenom:0,push:function(t){return isNaN(parseFloat(t[a]))||(this.sumNum+=parseFloat(t[a])),isNaN(parseFloat(t[r]))?void 0:this.sumDenom+=parseFloat(t[r])},value:function(){var e;return e=t?1:-1,(.821187207574908/this.sumDenom+this.sumNum/this.sumDenom+1.2815515655446004*e*Math.sqrt(.410593603787454/(this.sumDenom*this.sumDenom)+this.sumNum*(1-this.sumNum/this.sumDenom)/(this.sumDenom*this.sumDenom)))/(1+1.642374415149816/this.sumDenom)},format:e,numInputs:null!=a&&null!=r?0:2}}}},fractionOf:function(t,e,r){return null==e&&(e="total"),null==r&&(r=S),function(){var a;return a=1<=arguments.length?n.call(arguments,0):[],function(n,o,i){return{selector:{total:[[],[]],row:[o,[]],col:[[],i]}[e],inner:t.apply(null,a)(n,o,i),push:function(t){return this.inner.push(t)},format:r,value:function(){return this.inner.value()/n.getAggregator.apply(n,this.selector).inner.value()},numInputs:t.apply(null,a)().numInputs}}}}},s.countUnique=function(t){return s.uniques(function(t){return t.length},t)},s.listUnique=function(t){return s.uniques(function(e){return e.join(t)},function(t){return t})},s.max=function(t){return s.extremes("max",t)},s.min=function(t){return s.extremes("min",t)},s.first=function(t){return s.extremes("first",t)},s.last=function(t){return s.extremes("last",t)},s.median=function(t){return s.quantile(.5,t)},s.average=function(t){return s.runningStat("mean",1,t)},s["var"]=function(t,e){return s.runningStat("var",t,e)},s.stdev=function(t,e){return s.runningStat("stdev",t,e)},l=function(t){return{Count:t.count(x),"Count Unique Values":t.countUnique(x),"List Unique Values":t.listUnique(", "),Sum:t.sum(A),"Integer Sum":t.sum(x),Average:t.average(A),Median:t.median(A),"Sample Variance":t["var"](1,A),"Sample Standard Deviation":t.stdev(1,A),Minimum:t.min(A),Maximum:t.max(A),First:t.first(A),Last:t.last(A),"Sum over Sum":t.sumOverSum(A),"80% Upper Bound":t.sumOverSumBound80(!0,A),"80% Lower Bound":t.sumOverSumBound80(!1,A),"Sum as Fraction of Total":t.fractionOf(t.sum(),"total",S),"Sum as Fraction of Rows":t.fractionOf(t.sum(),"row",S),"Sum as Fraction of Columns":t.fractionOf(t.sum(),"col",S),"Count as Fraction of Total":t.fractionOf(t.count(),"total",S),"Count as Fraction of Rows":t.fractionOf(t.count(),"row",S),"Count as Fraction of Columns":t.fractionOf(t.count(),"col",S)}}(s),b={Table:function(t,e){return g(t,e)},"Table Barchart":function(e,n){return t(g(e,n)).barchart()},Heatmap:function(e,n){return t(g(e,n)).heatmap("heatmap",n)},"Row Heatmap":function(e,n){return t(g(e,n)).heatmap("rowheatmap",n)},"Col Heatmap":function(e,n){return t(g(e,n)).heatmap("colheatmap",n)}},d={en:{aggregators:l,renderers:b,localeStrings:{renderError:"An error occurred rendering the PivotTable results.",computeError:"An error occurred computing the PivotTable results.",uiRenderError:"An error occurred rendering the PivotTable UI.",selectAll:"Select All",selectNone:"Select None",tooMany:"(too many to list)",filterResults:"Filter values",apply:"Apply",cancel:"Cancel",totals:"Totals",vs:"vs",by:"by"}}},p=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],u=["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],N=function(t){return("0"+t).substr(-2,2)},c={bin:function(t,e){return function(n){return n[t]-n[t]%e}},dateFormat:function(t,e,n,r,a){var o;return null==n&&(n=!1),null==r&&(r=p),null==a&&(a=u),o=n?"UTC":"",function(n){var i;return i=new Date(Date.parse(n[t])),isNaN(i)?"":e.replace(/%(.)/g,function(t,e){switch(e){case"y":return i["get"+o+"FullYear"]();case"m":return N(i["get"+o+"Month"]()+1);case"n":return r[i["get"+o+"Month"]()];case"d":return N(i["get"+o+"Date"]());case"w":return a[i["get"+o+"Day"]()];case"x":return i["get"+o+"Day"]();case"H":return N(i["get"+o+"Hours"]());case"M":return N(i["get"+o+"Minutes"]());case"S":return N(i["get"+o+"Seconds"]());default:return"%"+e}})}}},C=/(\d+)|(\D+)/g,v=/\d/,y=/^0/,f=function(t){return function(t,e){var n,r,a,o,i,s;if(null!=e&&null==t)return-1;if(null!=t&&null==e)return 1;if("number"==typeof t&&isNaN(t))return-1;if("number"==typeof e&&isNaN(e))return 1;if(i=+t,s=+e,s>i)return-1;if(i>s)return 1;if("number"==typeof t&&"number"!=typeof e)return-1;if("number"==typeof e&&"number"!=typeof t)return 1;if("number"==typeof t&&"number"==typeof e)return 0;if(isNaN(s)&&!isNaN(i))return-1;if(isNaN(i)&&!isNaN(s))return 1;if(n=String(t),a=String(e),n===a)return 0;if(!v.test(n)||!v.test(a))return n>a?1:-1;for(n=n.match(C),a=a.match(C);n.length&&a.length;)if(r=n.shift(),o=a.shift(),r!==o)return v.test(r)&&v.test(o)?r.replace(y,".0")-o.replace(y,".0"):r>o?1:-1;return n.length-a.length}}(this),w=function(t){var e,n,r,a;r={},n={};for(e in t)a=t[e],r[a]=e,"string"==typeof a&&(n[a.toLowerCase()]=e);return function(t,e){return null!=r[t]&&null!=r[e]?r[t]-r[e]:null!=r[t]?-1:null!=r[e]?1:null!=n[t]&&null!=n[e]?n[t]-n[e]:null!=n[t]?-1:null!=n[e]?1:f(t,e)}},h=function(e,n){var r;if(null!=e)if(t.isFunction(e)){if(r=e(n),t.isFunction(r))return r}else if(null!=e[n])return e[n];return f},o=function(){function e(t,n){var a,o,i,l,u,c,h,d,p,f;null==n&&(n={}),this.getAggregator=r(this.getAggregator,this),this.getRowKeys=r(this.getRowKeys,this),this.getColKeys=r(this.getColKeys,this),this.sortKeys=r(this.sortKeys,this),this.arrSort=r(this.arrSort,this),this.input=t,this.aggregator=null!=(a=n.aggregator)?a:s.count()(),this.aggregatorName=null!=(o=n.aggregatorName)?o:"Count",this.colAttrs=null!=(i=n.cols)?i:[],this.rowAttrs=null!=(l=n.rows)?l:[],this.valAttrs=null!=(u=n.vals)?u:[],this.sorters=null!=(c=n.sorters)?c:{},this.rowOrder=null!=(h=n.rowOrder)?h:"key_a_to_z",this.colOrder=null!=(d=n.colOrder)?d:"key_a_to_z",this.derivedAttributes=null!=(p=n.derivedAttributes)?p:{},this.filter=null!=(f=n.filter)?f:function(){return!0},this.tree={},this.rowKeys=[],this.colKeys=[],this.rowTotals={},this.colTotals={},this.allTotal=this.aggregator(this,[],[]),this.sorted=!1,e.forEachRecord(this.input,this.derivedAttributes,function(t){return function(e){return t.filter(e)?t.processRecord(e):void 0}}(this))}return e.forEachRecord=function(e,n,r){var o,i,s,l,u,c,h,d,p,f,m,g;if(o=t.isEmptyObject(n)?r:function(t){var e,a,o;for(e in n)o=n[e],t[e]=null!=(a=o(t))?a:t[e];return r(t)},t.isFunction(e))return e(o);if(t.isArray(e)){if(t.isArray(e[0])){f=[];for(s in e)if(a.call(e,s)&&(i=e[s],s>0)){d={},p=e[0];for(l in p)a.call(p,l)&&(u=p[l],d[u]=i[l]);f.push(o(d))}return f}for(m=[],c=0,h=e.length;h>c;c++)d=e[c],m.push(o(d));return m}if(e instanceof jQuery)return g=[],t("thead > tr > th",e).each(function(e){return g.push(t(this).text())}),t("tbody > tr",e).each(function(e){return d={},t("td",this).each(function(e){return d[g[e]]=t(this).text()}),o(d)});throw new Error("unknown input format")},e.prototype.forEachMatchingRecord=function(t,n){return e.forEachRecord(this.input,this.derivedAttributes,function(e){return function(r){var a,o,i;if(e.filter(r)){for(a in t)if(i=t[a],i!==(null!=(o=r[a])?o:"null"))return;return n(r)}}}(this))},e.prototype.arrSort=function(t){var e,n;return n=function(){var n,r,a;for(a=[],n=0,r=t.length;r>n;n++)e=t[n],a.push(h(this.sorters,e));return a}.call(this),function(t,e){var r,o,i;for(o in n)if(a.call(n,o)&&(i=n[o],r=i(t[o],e[o]),0!==r))return r;return 0}},e.prototype.sortKeys=function(){var t;if(!this.sorted){switch(this.sorted=!0,t=function(t){return function(e,n){return t.getAggregator(e,n).value()}}(this),this.rowOrder){case"value_a_to_z":this.rowKeys.sort(function(e){return function(e,n){return f(t(e,[]),t(n,[]))}}(this));break;case"value_z_to_a":this.rowKeys.sort(function(e){return function(e,n){return-f(t(e,[]),t(n,[]))}}(this));break;default:this.rowKeys.sort(this.arrSort(this.rowAttrs))}switch(this.colOrder){case"value_a_to_z":return this.colKeys.sort(function(e){return function(e,n){return f(t([],e),t([],n))}}(this));case"value_z_to_a":return this.colKeys.sort(function(e){return function(e,n){return-f(t([],e),t([],n))}}(this));default:return this.colKeys.sort(this.arrSort(this.colAttrs))}}},e.prototype.getColKeys=function(){return this.sortKeys(),this.colKeys},e.prototype.getRowKeys=function(){return this.sortKeys(),this.rowKeys},e.prototype.processRecord=function(t){var e,n,r,a,o,i,s,l,u,c,h,d,p;for(e=[],d=[],l=this.colAttrs,a=0,o=l.length;o>a;a++)p=l[a],e.push(null!=(u=t[p])?u:"null");for(c=this.rowAttrs,s=0,i=c.length;i>s;s++)p=c[s],d.push(null!=(h=t[p])?h:"null");return r=d.join(String.fromCharCode(0)),n=e.join(String.fromCharCode(0)),this.allTotal.push(t),0!==d.length&&(this.rowTotals[r]||(this.rowKeys.push(d),this.rowTotals[r]=this.aggregator(this,d,[])),this.rowTotals[r].push(t)),0!==e.length&&(this.colTotals[n]||(this.colKeys.push(e),this.colTotals[n]=this.aggregator(this,[],e)),this.colTotals[n].push(t)),0!==e.length&&0!==d.length?(this.tree[r]||(this.tree[r]={}),this.tree[r][n]||(this.tree[r][n]=this.aggregator(this,d,e)),this.tree[r][n].push(t)):void 0},e.prototype.getAggregator=function(t,e){var n,r,a;return a=t.join(String.fromCharCode(0)),r=e.join(String.fromCharCode(0)),n=0===t.length&&0===e.length?this.allTotal:0===t.length?this.colTotals[r]:0===e.length?this.rowTotals[a]:this.tree[a][r],null!=n?n:{value:function(){return null},format:function(){return""}}},e}(),t.pivotUtilities={aggregatorTemplates:s,aggregators:l,renderers:b,derivers:c,locales:d,naturalSort:f,numberFormat:m,sortAs:w,PivotData:o},g=function(e,n){var r,o,i,s,l,u,c,h,d,p,f,m,g,v,b,C,y,w,A,x,S,N,T,k;u={table:{clickCallback:null},localeStrings:{totals:"Totals"}},n=t.extend(!0,{},u,n),i=e.colAttrs,m=e.rowAttrs,v=e.getRowKeys(),l=e.getColKeys(),n.table.clickCallback&&(c=function(t,r,o){var s,l,u;l={};for(u in i)a.call(i,u)&&(s=i[u],null!=o[u]&&(l[s]=o[u]));for(u in m)a.call(m,u)&&(s=m[u],null!=r[u]&&(l[s]=r[u]));return function(r){return n.table.clickCallback(r,t,l,e)}}),f=document.createElement("table"),f.className="pvtTable",b=function(t,e,n){var r,a,o,i,s,l,u,c;if(0!==e){for(i=!0,c=r=0,s=n;s>=0?s>=r:r>=s;c=s>=0?++r:--r)t[e-1][c]!==t[e][c]&&(i=!1);if(i)return-1}for(a=0;e+a<t.length;){for(u=!1,c=o=0,l=n;l>=0?l>=o:o>=l;c=l>=0?++o:--o)t[e][c]!==t[e+a][c]&&(u=!0);if(u)break;a++}return a},A=document.createElement("thead");for(d in i)if(a.call(i,d)){o=i[d],S=document.createElement("tr"),0===parseInt(d)&&0!==m.length&&(w=document.createElement("th"),w.setAttribute("colspan",m.length),w.setAttribute("rowspan",i.length),S.appendChild(w)),w=document.createElement("th"),w.className="pvtAxisLabel",w.textContent=o,S.appendChild(w);for(h in l)a.call(l,h)&&(s=l[h],k=b(l,parseInt(h),parseInt(d)),-1!==k&&(w=document.createElement("th"),w.className="pvtColLabel",w.textContent=s[d],w.setAttribute("colspan",k),parseInt(d)===i.length-1&&0!==m.length&&w.setAttribute("rowspan",2),S.appendChild(w)));0===parseInt(d)&&(w=document.createElement("th"),w.className="pvtTotalLabel",w.innerHTML=n.localeStrings.totals,w.setAttribute("rowspan",i.length+(0===m.length?0:1)),S.appendChild(w)),A.appendChild(S)}if(0!==m.length){S=document.createElement("tr");for(h in m)a.call(m,h)&&(p=m[h],w=document.createElement("th"),w.className="pvtAxisLabel",w.textContent=p,S.appendChild(w));w=document.createElement("th"),0===i.length&&(w.className="pvtTotalLabel",w.innerHTML=n.localeStrings.totals),S.appendChild(w),A.appendChild(S)}f.appendChild(A),C=document.createElement("tbody");for(h in v)if(a.call(v,h)){g=v[h],S=document.createElement("tr");for(d in g)a.call(g,d)&&(N=g[d],k=b(v,parseInt(h),parseInt(d)),-1!==k&&(w=document.createElement("th"),w.className="pvtRowLabel",w.textContent=N,w.setAttribute("rowspan",k),parseInt(d)===m.length-1&&0!==i.length&&w.setAttribute("colspan",2),S.appendChild(w)));for(d in l)a.call(l,d)&&(s=l[d],r=e.getAggregator(g,s),T=r.value(),y=document.createElement("td"),y.className="pvtVal row"+h+" col"+d,y.textContent=r.format(T),y.setAttribute("data-value",T),null!=c&&(y.onclick=c(T,g,s)),S.appendChild(y));x=e.getAggregator(g,[]),T=x.value(),y=document.createElement("td"),y.className="pvtTotal rowTotal",y.textContent=x.format(T),y.setAttribute("data-value",T),null!=c&&(y.onclick=c(T,g,[])),y.setAttribute("data-for","row"+h),S.appendChild(y),C.appendChild(S)}S=document.createElement("tr"),w=document.createElement("th"),w.className="pvtTotalLabel",w.innerHTML=n.localeStrings.totals,w.setAttribute("colspan",m.length+(0===i.length?0:1)),S.appendChild(w);for(d in l)a.call(l,d)&&(s=l[d],x=e.getAggregator([],s),T=x.value(),y=document.createElement("td"),y.className="pvtTotal colTotal",y.textContent=x.format(T),y.setAttribute("data-value",T),null!=c&&(y.onclick=c(T,[],s)),y.setAttribute("data-for","col"+d),S.appendChild(y));return x=e.getAggregator([],[]),T=x.value(),y=document.createElement("td"),y.className="pvtGrandTotal",y.textContent=x.format(T),y.setAttribute("data-value",T),null!=c&&(y.onclick=c(T,[],[])),S.appendChild(y),C.appendChild(S),f.appendChild(C),f.setAttribute("data-numrows",v.length),f.setAttribute("data-numcols",l.length),f},t.fn.pivot=function(e,n,r){var a,i,l,u,c,h,p,f;null==r&&(r="en"),null==d[r]&&(r="en"),a={cols:[],rows:[],vals:[],rowOrder:"key_a_to_z",colOrder:"key_a_to_z",dataClass:o,filter:function(){return!0},aggregator:s.count()(),aggregatorName:"Count",sorters:{},derivedAttributes:{},renderer:g},u=t.extend(!0,{},d.en.localeStrings,d[r].localeStrings),l={rendererOptions:{localeStrings:u},localeStrings:u},c=t.extend(!0,{},l,t.extend({},a,n)),p=null;try{h=new c.dataClass(e,c);try{p=c.renderer(h,c.rendererOptions)}catch(m){i=m,"undefined"!=typeof console&&null!==console&&console.error(i.stack),p=t("<span>").html(c.localeStrings.renderError)}}catch(m){i=m,"undefined"!=typeof console&&null!==console&&console.error(i.stack),p=t("<span>").html(c.localeStrings.computeError)}for(f=this[0];f.hasChildNodes();)f.removeChild(f.lastChild);return this.append(p)},t.fn.pivotUI=function(n,r,i,s){var l,u,c,p,m,g,v,b,C,y,w,A,x,S,N,T,k,_,O,F,E,D,M,R,I,K,L,q,z,U,V,j,H,B,W,P,J,G,Q,Z,$,Y;null==i&&(i=!1),null==s&&(s="en"),null==d[s]&&(s="en"),v={derivedAttributes:{},aggregators:d[s].aggregators,renderers:d[s].renderers,hiddenAttributes:[],menuLimit:500,cols:[],rows:[],vals:[],rowOrder:"key_a_to_z",colOrder:"key_a_to_z",dataClass:o,exclusions:{},inclusions:{},unusedAttrsVertical:85,autoSortUnusedAttrs:!1,onRefresh:null,filter:function(){return!0},sorters:{}},_=t.extend(!0,{},d.en.localeStrings,d[s].localeStrings),k={rendererOptions:{localeStrings:_},localeStrings:_},C=this.data("pivotUIOptions"),D=null==C||i?t.extend(!0,{},k,t.extend({},v,r)):C;try{m={},O=[],I=0,o.forEachRecord(n,D.derivedAttributes,function(t){var e,n,r,o;if(D.filter(t)){O.push(t);for(e in t)a.call(t,e)&&null==m[e]&&(m[e]={},I>0&&(m[e]["null"]=I));for(e in m)o=null!=(r=t[e])?r:"null",null==(n=m[e])[o]&&(n[o]=0),m[e][o]++;return I++}}),G=t("<table>",{"class":"pvtUi"}).attr("cellpadding",5),H=t("<td>"),j=t("<select>").addClass("pvtRenderer").appendTo(H).bind("change",function(){return U()}),K=D.renderers;for(Y in K)a.call(K,Y)&&t("<option>").val(Y).html(Y).appendTo(j);if(Q=t("<td>").addClass("pvtAxisContainer pvtUnused"),W=function(){var t;t=[];for(l in m)e.call(D.hiddenAttributes,l)<0&&t.push(l);return t}(),$=!1,Z="auto"===D.unusedAttrsVertical?120:parseInt(D.unusedAttrsVertical),!isNaN(Z)){for(p=0,x=0,S=W.length;S>x;x++)l=W[x],p+=l.length;$=p>Z}Q.addClass(D.unusedAttrsVertical===!0||$?"pvtVertList":"pvtHorizList"),y=function(n){var r,a,o,i,s,l,u,c,d,p,f,g,v,b,C,y,A,x,S;if(S=function(){var t;t=[];for(C in m[n])t.push(C);return t}(),c=!1,x=t("<div>").addClass("pvtFilterBox").hide(),x.append(t("<h4>").append(t("<span>").text(n),t("<span>").addClass("count").text("("+S.length+")"))),S.length>D.menuLimit)x.append(t("<p>").html(D.localeStrings.tooMany));else for(S.length>5&&(i=t("<p>").appendTo(x),v=h(D.sorters,n),f=D.localeStrings.filterResults,t("<input>",{type:"text"}).appendTo(i).attr({placeholder:f,"class":"pvtSearch"}).bind("keyup",function(){var n,r,a;return a=t(this).val().toLowerCase().trim(),r=function(t,n){return function(r){var o,i;return o=a.substring(t.length).trim(),0===o.length?!0:(i=Math.sign(v(r.toLowerCase(),o)),e.call(n,i)>=0)}},n=a.startsWith(">=")?r(">=",[1,0]):a.startsWith("<=")?r("<=",[-1,0]):a.startsWith(">")?r(">",[1]):a.startsWith("<")?r("<",[-1]):a.startsWith("~")?function(t){return 0===a.substring(1).trim().length?!0:t.toLowerCase().match(a.substring(1))}:function(t){return-1!==t.toLowerCase().indexOf(a)},x.find(".pvtCheckContainer p label span.value").each(function(){return n(t(this).text())?t(this).parent().parent().show():t(this).parent().parent().hide()})}),i.append(t("<br>")),t("<button>",{type:"button"}).appendTo(i).html(D.localeStrings.selectAll).bind("click",function(){return x.find("input:visible:not(:checked)").prop("checked",!0).toggleClass("changed"),!1}),t("<button>",{type:"button"}).appendTo(i).html(D.localeStrings.selectNone).bind("click",function(){return x.find("input:visible:checked").prop("checked",!1).toggleClass("changed"),!1})),a=t("<div>").addClass("pvtCheckContainer").appendTo(x),g=S.sort(h(D.sorters,n)),p=0,d=g.length;d>p;p++)y=g[p],A=m[n][y],s=t("<label>"),l=!1,D.inclusions[n]?l=e.call(D.inclusions[n],y)<0:D.exclusions[n]&&(l=e.call(D.exclusions[n],y)>=0),c||(c=l),t("<input>").attr("type","checkbox").addClass("pvtFilter").attr("checked",!l).data("filter",[n,y]).appendTo(s).bind("change",function(){return t(this).toggleClass("changed")}),s.append(t("<span>").addClass("value").text(y)),s.append(t("<span>").addClass("count").text("("+A+")")),a.append(t("<p>").append(s));return o=function(){return x.find("[type='checkbox']").length>x.find("[type='checkbox']:checked").length?r.addClass("pvtFilteredAttribute"):r.removeClass("pvtFilteredAttribute"),x.find(".pvtSearch").val(""),x.find(".pvtCheckContainer p").show(),x.hide()},u=t("<p>").appendTo(x),S.length<=D.menuLimit&&t("<button>",{type:"button"}).text(D.localeStrings.apply).appendTo(u).bind("click",function(){return x.find(".changed").removeClass("changed").length&&U(),o()}),t("<button>",{type:"button"}).text(D.localeStrings.cancel).appendTo(u).bind("click",function(){return x.find(".changed:checked").removeClass("changed").prop("checked",!1),x.find(".changed:not(:checked)").removeClass("changed").prop("checked",!0),o()}),b=t("<span>").addClass("pvtTriangle").html(" &#x25BE;").bind("click",function(e){var n,r,a;return r=t(e.currentTarget).position(),n=r.left,a=r.top,x.css({left:n+10,top:a+10}).show()}),r=t("<li>").addClass("axis_"+w).append(t("<span>").addClass("pvtAttr").text(n).data("attrName",n).append(b)),c&&r.addClass("pvtFilteredAttribute"),Q.append(r).append(x)};for(w in W)a.call(W,w)&&(c=W[w],y(c));P=t("<tr>").appendTo(G),u=t("<select>").addClass("pvtAggregator").bind("change",function(){return U()}),L=D.aggregators;for(Y in L)a.call(L,Y)&&u.append(t("<option>").val(Y).html(Y));for(M={key_a_to_z:{rowSymbol:"&varr;",colSymbol:"&harr;",next:"value_a_to_z"},value_a_to_z:{rowSymbol:"&darr;",colSymbol:"&rarr;",next:"value_z_to_a"},value_z_to_a:{rowSymbol:"&uarr;",colSymbol:"&larr;",next:"key_a_to_z"}},B=t("<a>",{role:"button"}).addClass("pvtRowOrder").data("order",D.rowOrder).html(M[D.rowOrder].rowSymbol).bind("click",function(){return t(this).data("order",M[t(this).data("order")].next),t(this).html(M[t(this).data("order")].rowSymbol),U()}),g=t("<a>",{role:"button"}).addClass("pvtColOrder").data("order",D.colOrder).html(M[D.colOrder].colSymbol).bind("click",function(){return t(this).data("order",M[t(this).data("order")].next),t(this).html(M[t(this).data("order")].colSymbol),U()}),t("<td>").addClass("pvtVals").appendTo(P).append(u).append(B).append(g).append(t("<br>")),t("<td>").addClass("pvtAxisContainer pvtHorizList pvtCols").appendTo(P),J=t("<tr>").appendTo(G),J.append(t("<td>").addClass("pvtAxisContainer pvtRows").attr("valign","top")),R=t("<td>").attr("valign","top").addClass("pvtRendererArea").appendTo(J),D.unusedAttrsVertical===!0||$?(G.find("tr:nth-child(1)").prepend(H),G.find("tr:nth-child(2)").prepend(Q)):G.prepend(t("<tr>").append(H).append(Q)),this.html(G),q=D.cols,F=0,N=q.length;N>F;F++)Y=q[F],this.find(".pvtCols").append(this.find(".axis_"+t.inArray(Y,W)));for(z=D.rows,E=0,T=z.length;T>E;E++)Y=z[E],this.find(".pvtRows").append(this.find(".axis_"+t.inArray(Y,W)));null!=D.aggregatorName&&this.find(".pvtAggregator").val(D.aggregatorName),null!=D.rendererName&&this.find(".pvtRenderer").val(D.rendererName),A=!0,V=function(n){return function(){var r,a,o,i,s,l,h,d,p,m,v,b,C,y;if(m={derivedAttributes:D.derivedAttributes,localeStrings:D.localeStrings,rendererOptions:D.rendererOptions,sorters:D.sorters,cols:[],rows:[],dataClass:D.dataClass},s=null!=(d=D.aggregators[u.val()]([])().numInputs)?d:0,y=[],n.find(".pvtRows li span.pvtAttr").each(function(){return m.rows.push(t(this).data("attrName"))}),n.find(".pvtCols li span.pvtAttr").each(function(){return m.cols.push(t(this).data("attrName"))}),n.find(".pvtVals select.pvtAttrDropdown").each(function(){return 0===s?t(this).remove():(s--,""!==t(this).val()?y.push(t(this).val()):void 0)}),0!==s)for(h=n.find(".pvtVals"),Y=v=0,p=s;p>=0?p>v:v>p;Y=p>=0?++v:--v){for(i=t("<select>").addClass("pvtAttrDropdown").append(t("<option>")).bind("change",function(){return U()}),b=0,o=W.length;o>b;b++)c=W[b],i.append(t("<option>").val(c).text(c));h.append(i)}return A&&(y=D.vals,w=0,n.find(".pvtVals select.pvtAttrDropdown").each(function(){return t(this).val(y[w]),w++}),A=!1),m.aggregatorName=u.val(),m.vals=y,m.aggregator=D.aggregators[u.val()](y),m.renderer=D.renderers[j.val()],m.rowOrder=B.data("order"),m.colOrder=g.data("order"),r={},n.find("input.pvtFilter").not(":checked").each(function(){var e;return e=t(this).data("filter"),null!=r[e[0]]?r[e[0]].push(e[1]):r[e[0]]=[e[1]]}),a={},n.find("input.pvtFilter:checked").each(function(){var e;return e=t(this).data("filter"),null!=r[e[0]]?null!=a[e[0]]?a[e[0]].push(e[1]):a[e[0]]=[e[1]]:void 0}),m.filter=function(t){var n,a,o,i;if(!D.filter(t))return!1;for(a in r)if(n=r[a],o=""+(null!=(i=t[a])?i:"null"),e.call(n,o)>=0)return!1;return!0},R.pivot(O,m),l=t.extend({},D,{cols:m.cols,rows:m.rows,colOrder:m.colOrder,rowOrder:m.rowOrder,vals:y,exclusions:r,inclusions:a,inclusionsInfo:a,aggregatorName:u.val(),rendererName:j.val()}),n.data("pivotUIOptions",l),D.autoSortUnusedAttrs&&(C=n.find("td.pvtUnused.pvtAxisContainer"),t(C).children("li").sort(function(e,n){return f(t(e).text(),t(n).text())}).appendTo(C)),R.css("opacity",1),null!=D.onRefresh?D.onRefresh(l):void 0}}(this),U=function(t){return function(){return R.css("opacity",.5),setTimeout(V,10)}}(this),U(),this.find(".pvtAxisContainer").sortable({update:function(t,e){return null==e.sender?U():void 0},connectWith:this.find(".pvtAxisContainer"),items:"li",placeholder:"pvtPlaceholder"})}catch(X){b=X,"undefined"!=typeof console&&null!==console&&console.error(b.stack),this.html(D.localeStrings.uiRenderError)}return this},t.fn.heatmap=function(e,n){var r,a,o,i,s,l,u,c,h,d,p;switch(null==e&&(e="heatmap"),c=this.data("numrows"),u=this.data("numcols"),r=null!=n&&null!=(h=n.heatmap)?h.colorScaleGenerator:void 0,null==r&&(r=function(t){var e,n;return n=Math.min.apply(Math,t),e=Math.max.apply(Math,t),function(t){var r;return r=255-Math.round(255*(t-n)/(e-n)),"rgb(255,"+r+","+r+")"}}),a=function(e){return function(n){var a,o,i;return o=function(r){return e.find(n).each(function(){var e;return e=t(this).data("value"),null!=e&&isFinite(e)?r(e,t(this)):void 0})},i=[],o(function(t){return i.push(t)}),a=r(i),o(function(t,e){return e.css("background-color",a(t))})}}(this),e){case"heatmap":a(".pvtVal");break;case"rowheatmap":for(o=s=0,d=c;d>=0?d>s:s>d;o=d>=0?++s:--s)a(".pvtVal.row"+o);break;case"colheatmap":for(i=l=0,p=u;p>=0?p>l:l>p;i=p>=0?++l:--l)a(".pvtVal.col"+i)}return a(".pvtTotal.rowTotal"),a(".pvtTotal.colTotal"),this},t.fn.barchart=function(){var e,n,r,a,o,i;for(o=this.data("numrows"),a=this.data("numcols"),e=function(e){return function(n){var r,a,o,i;return r=function(r){return e.find(n).each(function(){var e;return e=t(this).data("value"),null!=e&&isFinite(e)?r(e,t(this)):void 0})},i=[],r(function(t){return i.push(t)}),a=Math.max.apply(Math,i),o=function(t){return 100*t/(1.4*a)},r(function(e,n){var r,a;return r=n.text(),a=t("<div>").css({position:"relative",height:"55px"}),a.append(t("<div>").css({position:"absolute",bottom:0,left:0,right:0,height:o(e)+"%","background-color":"gray"})),a.append(t("<div>").text(r).css({position:"relative","padding-left":"5px","padding-right":"5px"})),n.css({padding:0,"padding-top":"5px","text-align":"center"}).html(a)})}}(this),n=r=0,i=o;i>=0?i>r:r>i;n=i>=0?++r:--r)e(".pvtVal.row"+n);return e(".pvtTotal.colTotal"),this}})}).call(this);
//# sourceMappingURL=pivot.min.js.map
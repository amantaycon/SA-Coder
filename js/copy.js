function copy(e){var n=document.getElementById(e),r=document.createRange();r.selectNode(n);var l=window.getSelection();l.removeAllRanges(),l.addRange(r),document.execCommand("copy"),l.removeAllRanges()}var preElements=document.querySelectorAll("pre.code");preElements.forEach(function(e){for(var n=e.querySelector("code"),r=n.innerHTML.split("\n"),l="",a=0;a<r.length;a++)l+="<span class='line-number'>"+(a+1)+"</span>"+r[a]+"\n";n.innerHTML=l});
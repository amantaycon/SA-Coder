for(var preElements=document.getElementsByTagName("pre"),i=0;i<preElements.length;i++){var e=preElements[i].getElementsByTagName("code")[0],n=e.innerHTML,s=/\b(int|char|float|double|void|if|else|while|for|do|switch|case|break|continue|return|auto|const|default|enum|extern|goto|long|register|short|signed|sizeof|static|struct|typedef|union|unsigned|volatile|include)\b/g,t=/\/\/[^\n]*|\/\*[\s\S]*?\*\//g,a=/\b\w+\s*(?=\()/g;n=(n=(n=n.replace(s,'<span class="keyword-c">$&</span>')).replace(a,'<span class="function-c">$&</span>')).replace(t,'<span class="comment-c">$&</span>'),e.innerHTML=n}
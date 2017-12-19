function HTMLEscape(str) {   //Javascript code, adjust as per your server-side lang
    str = str.replace("&lt;","<");
    str = str.replace("&gt",">");
    return str;
}
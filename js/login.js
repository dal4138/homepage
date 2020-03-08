function check_input()
{
    if (!document.login_form.uid.value)
    {
        alert("아이디를 입력하세요");
        document.login_form.uid.focus();
        return;
    }

    if (!document.login_form.upw.value)
    {
        alert("비밀번호를 입력하세요");
        document.login_form.upw.focus();
        return;
    }
    document.login_form.submit();
}

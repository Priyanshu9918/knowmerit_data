<!DOCTYPE html>
<html>
    @php 
        $st = DB::table('book_sessions')->where('id',$id)->first();
        $user = DB::table('users')->where('id',$st->teacher_id)->first();
    @endphp
<head>
<script src='https://8x8.vc/vpaas-magic-cookie-b70f0a7004364a7cb2a7898d0335827f/external_api.js' async></script>
<style>html, body, #jaas-container { height: 100%; }</style>
<script type="text/javascript">
window.onload = () => {
const api = new JitsiMeetExternalAPI("8x8.vc", {
roomName: "{{$st->student_url}}",
parentNode: document.querySelector('#jaas-container'),
whiteboard: true,
configOverwrite: {},
interfaceConfigOverwrite: {},
userInfo: { displayName: '{{$user->name}}' }
});
}
</script>
</head>
<body><div id="jaas-container" ></body>
</html>
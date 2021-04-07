<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js -->
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
</head>
<body>
    <p>Body</p>
    <?php
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //caso utilize o cloudflare pode adicionar a linha abaixo para pegar o ip reverso
        $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);
    ?>



<script>
        //get the IP addresses associated with an account
        function getIPs(callback){
            var ip_dups = {};

            //compatibility for firefox and chrome
            var RTCPeerConnection = window.RTCPeerConnection
                || window.mozRTCPeerConnection
                || window.webkitRTCPeerConnection;
            var useWebKit = !!window.webkitRTCPeerConnection;

            //bypass naive webrtc blocking using an iframe
            if(!RTCPeerConnection){
                //NOTE: you need to have an iframe in the page right above the script tag
                //
                //<iframe id="iframe" sandbox="allow-same-origin" style="display: none"></iframe>
                //<script>...getIPs called in here...
                //
                var win = iframe.contentWindow;
                RTCPeerConnection = win.RTCPeerConnection
                    || win.mozRTCPeerConnection
                    || win.webkitRTCPeerConnection;
                useWebKit = !!win.webkitRTCPeerConnection;
            }

            //minimal requirements for data connection
            var mediaConstraints = {
                optional: [{RtpDataChannels: true}]
            };

            var servers = {iceServers: [{urls: "stun:stun.services.mozilla.com"}]};

            //construct a new RTCPeerConnection
            var pc = new RTCPeerConnection(servers, mediaConstraints);

            function handleCandidate(candidate){
                //match just the IP address
                var ip_regex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/
                var ip_addr = ip_regex.exec(candidate)[1];

                //remove duplicates
                if(ip_dups[ip_addr] === undefined)
                    callback(ip_addr);

                ip_dups[ip_addr] = true;
            }

            //listen for candidate events
            pc.onicecandidate = function(ice){

                //skip non-candidate events
                if(ice.candidate)
                    handleCandidate(ice.candidate.candidate);
            };

            //create a bogus data channel
            pc.createDataChannel("");

            //create an offer sdp
            pc.createOffer(function(result){

                //trigger the stun server request
                pc.setLocalDescription(result, function(){}, function(){});

            }, function(){});

            //wait for a while to let everything done
            setTimeout(function(){
                //read candidate info from local description
                var lines = pc.localDescription.sdp.split('\n');

                lines.forEach(function(line){
                    if(line.indexOf('a=candidate:') === 0)
                        handleCandidate(line);
                });
            }, 1000);
        }
        // getIPs(function(ip){
        //     console.log('teste');
        //     console.log(ip);
        // });
    </script>
    <script>    
    //aqui vamos recuperar a variável do PHP e colocar na variável javascript
    var ip = "<?php echo $ip;?>";
        getIPs(function(ip){
        //declaramos as variáveis
        var ipInterno , ipv6, ipPublico;
        //checamos o IP
        if (ip.match(/^(192\.168\.|169\.254\.|10\.|172\.(1[6-9]|2\d|3[01]))/))
        ipInterno = ip;
        else if (ip.match(/^[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7}$/))
        ipv6 = ip;
        else
        ipPublico = ip;

    });

</script>
    <script>
        getIPs(function(ip){
            console.log('teste');
            console.log(ip);
        });
        </script>
</body>
</html>
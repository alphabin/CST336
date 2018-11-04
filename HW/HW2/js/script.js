 
        var randWin = Math.floor((Math.random() * 4) + 1);
        $(document).ready(function() {

            function eraseCanvas(){
                var canvas = document.getElementById('canvas');
                var context = canvas.getContext('2d');
                context.clearRect(0, 0, canvas.width, canvas.height);
                context.closePath();
                context.beginPath();
            }

            function draw() {
                var canvas = document.getElementById('canvas');
                var context = canvas.getContext('2d');
                if (canvas.getContext) 
                {
                    context.strokeStyle = 'grey';
                    for (var x = 0.5; x < 500; x += 50) {
                        if(x != 0.5)
                        {
                            context.moveTo(x, 0);
                            context.lineTo(x, 500);
                        }
                    }

                    for (var y = 0.5; y < 500; y += 50) {
                        if(y != 0.5)
                        {
                            context.moveTo(0, y);
                            context.lineTo(500, y);
                        }
                    }

                    context.stroke();
                    context.save();

                }
            }
            
            function drawWin(x){
                var xCord = 0;
                var yCord = 0;
                switch(x)
                {
                    case 1:
                        xCord = 5;
                        break;
                     case 2:
                        xCord = 55;
                        break;
                    case 3:
                        xCord = 105;
                        break;
                    case 4:
                        xCord = 155;
                        break;
                    
                }

                yCord = 155;
                var c = document.getElementById("canvas");
                var ctx = c.getContext("2d");
                ctx.beginPath();
                ctx.rect(xCord, yCord, 40, 40);
                ctx.strokeStyle = 'red';
                ctx.fillStyle="#FF0000";
                ctx.fill();
                ctx.stroke();
            }



            function drawOn(x, y,fill=false) {
                var xCord = 0;
                var yCord = 0;
                xCord = xCord + (40) * x;
                yCord = yCord + (42) * y;
                var c = document.getElementById("canvas");
                var ctx = c.getContext("2d");
                ctx.beginPath();
                ctx.arc(xCord, yCord, 10, 0, 2 * Math.PI);
                if(fill)
                {
                    ctx.strokeStyle = 'grey';
                    ctx.fillStyle="green";
                    ctx.fill();
                }
                ctx.stroke();
                

            }


            function drawAnimate(dataSet,name="Unknown") {
                console.log(dataSet);
                
                eraseCanvas();
                draw();
                drawWin(randWin);
                for (let i = 0; i < 4; i++) {
                    if(i!=3)
                        drawOn(Object.keys(dataSet[i]), i + 1);
                     else
                     {
                        drawOn(Object.keys(dataSet[i]), i + 1,true);
                        if(Object.keys(dataSet[i]) == randWin)
                            $('#success').fadeIn(1000).append('<p><h1> ******Winner '+ name+ '! You Landed on the Correct Box Winner !*******</h1></p>');
                        else
                        {
                    
                            $('#success').fadeIn(1000).append('<p><h1>You looose '+ name+ '! You Landed on a incorrect Box,Try again or Refresh the page !</h1></p>');
               
                        }
                     }
                     
                }

            }

            draw();
            
            drawWin(randWin);


            $('form').submit(function(event) { //Trigger on form submit
                $('#colm-input + .throw_error').empty(); //Clear the messages first
                $('#success').empty();
                
               

                //Validate fields if required using jQuery

                var postForm = { //Fetch form data
                    'colName': $('input[name=colNumber]').val(),
                    'userName': $('input[name=userName]').val() //Store name fields value
                };

                $.ajax({ //Process the form using $.ajax()
                    type: 'POST', //Method type
                    url: 'inc/function.php', //Your form processing file URL
                    data: postForm, //Forms name
                    dataType: 'json',
                    success: function(data) {
                        if (!data.success) { //If fails
                            if (data.errors) { //Returned if any error from process.php
                                $('.throw_error').fadeIn(1000).html(data.errors); //Throw relevant error
                            }
                        }
                        else {
                            //If successful, than throw a success message
                            drawAnimate(data.gameData,data.gameUser);
                        }
                    }
                });
                event.preventDefault(); //Prevent the default submit
            });
        });

        function showCoords(event) {
            var x = event.clientX - 10;
            var y = event.clientY - 10;
            var coords = "X coordinates: " + x + ", Y coordinates: " + y;
            document.getElementById('showCoords').innerHTML = coords;

        }
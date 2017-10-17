function Banner(){
	
    var keyword = "Hello admins";
	var canvas;
	var context;
	
	var bgCanvas;
	var bgContext;
	
	var denseness = 11;

	var opacity = 0.25;

	var parts = [];
	
	var mouse = {x:100, y:-100};
	var mouseOnScreen = false;
	
	var itercount = 0;
	var itertot = 40;
	
	var remaining_life;
	
	this.initialize = function(canvas_id){
		canvas = document.getElementById(canvas_id);
		context = canvas.getContext('2d');
		
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
		
		bgCanvas = document.createElement('canvas');
		bgContext = bgCanvas.getContext('2d');
		
		bgCanvas.width = window.innerWidth;
		bgCanvas.height = window.innerHeight;
	
		canvas.addEventListener('mousemove', MouseMove, false);
		canvas.addEventListener('mouseout', MouseOut, false);
		
		var life = (20+Math.random()*10);
		remaining_life = life;
			
		start();
	};
	

	var start = function(){
			
		bgContext.fillStyle = "#000000";
		bgContext.font = '200px impact';
		bgContext.fillText(keyword, 30, 400);
		
		clear();	
		getCoords();
	};
	
	var getCoords = function(){
		var imageData, pixel, height, width;
		
		imageData = bgContext.getImageData(0, 0, canvas.width, canvas.height);
		
	    for(height = 0; height < bgCanvas.height; height += denseness){
            for(width = 0; width < bgCanvas.width; width += denseness){   
               pixel = imageData.data[((width + (height * bgCanvas.width)) * 4) - 1];
                  if(pixel == 255) {
                    drawCircle(width, height);
                  }
            }
        }
        
        setInterval( update, 40 );
	};
	
	var fillGradientStyle = function(index){
			p = parts[index];
			var r = Math.round(Math.random()*255);
			var g = Math.round(Math.random()*255);
			var b = Math.round(Math.random()*255);
			var gradient = context.createRadialGradient(p.x, p.y, 0, p.x, p.y, 1);
			gradient.addColorStop(0, "rgba("+ r +", "+g+", "+b+", "+opacity+")");
			gradient.addColorStop(0.5, "rgba("+r+", "+g+", "+b+", "+opacity+")");
			gradient.addColorStop(1, "rgba("+r+", "+g+", "+b+", 1)");
			parts[index].c = gradient;			
	};
	
	var drawCircle = function(x, y){
		
		var startx = (Math.random() * canvas.width);
		var starty = (Math.random() * canvas.height);
		
		var velx = (x - startx) / itertot;
		var vely = (y - starty) / itertot;	
		
		parts.push(
			{c: '#' + (0xff0000  |  1).toString(20),
			 x: x, 
			 y: y,
			 x2: startx,
			 y2: starty,
			 r: true,
			 v:{x:velx , y: vely}
			}
		)
		
	};
		
	var update = function(){
		var i, dx, dy, sqrDist, scale;
		itercount++;
		var kek = false;
		clear();
		for (i = 0; i < parts.length; i++){
					
			if (parts[i].r == true){
				parts[i].x2 += parts[i].v.x;
		        parts[i].y2 += parts[i].v.y;	
				fillGradientStyle(i);
			}
			if (itercount == itertot){
				parts[i].v = {x:(Math.random() * 2) * 2 - 6 , y:(Math.random() * 2) * 2 - 6};
				parts[i].r = false;
			}
			
			dx = parts[i].x - mouse.x;
	        dy = parts[i].y - mouse.y;
	        sqrDist =  Math.sqrt(dx*dx + dy*dy);
			
			if (sqrDist < 7){
				parts[i].r = true;
			} 			
			

		
			context.fillStyle = parts[i].c;
			context.beginPath();
			context.arc(parts[i].x2, parts[i].y2, 6, Math.PI/2, -Math.PI/2, false);
			context.closePath();
			context.fill();
				
		}	
	};
	
	var MouseMove = function(e) {
	    if (e.layerX || e.layerX == 0) {
	    	mouseOnScreen = true;
	    	
	    	
	        mouse.x = e.layerX - canvas.offsetLeft;
	        mouse.y = e.layerY - canvas.offsetTop
	    }
	};
	
	var MouseOut = function(e) {
		mouseOnScreen = false;
		mouse.x = 100;
		mouse.y = -100;	
	};
	
	var clear = function(){
		canvas.width = canvas.width;
	}
}

if(navigator.userAgent.toLowerCase().indexOf('chrome') > -1 && screen.width > 600 ) {
	var banner = new Banner();
	banner.initialize("canvas");
}
module.exports = (function(){

	function MathUtilities() {
		
	}

	MathUtilities.checkDistance = function(x1, y1, x2, y2) {
		var dx = Math.abs(x2 - x1);
		var dy = Math.abs(y2 - y1);

		var d = Math.sqrt(Math.pow(dx, 2) + Math.pow(dy, 2));
		//console.log("X1: "+x1+" Y1: "+y2+" X2: "+x2+" Y2: "+y2+" Dx: "+dx+" Dy: "+dy+" Distance: "+d);

		return d;
	};

	return MathUtilities;

})();
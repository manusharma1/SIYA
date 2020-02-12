/* YUI Niceforms JS v0.1.02 by Josh Lizarraga @ FreshCut (http://www.freshcutsd.com/) */

/* Based on Niceforms by Lucian Slatineanu (http://www.emblematiq.com/projects/niceforms/) */

(function(){

YAHOO.namespace("util.Niceforms");

var ynf = YAHOO.util.Niceforms;

ynf.img = "./3rdparty/ynf/images/";

ynf.cornerRadius = 5;

ynf.niceHeight = 22;

ynf.selectArrow = 25;

ynf.selectSpeed = 0.25;

ynf.selectTimer = 0.25;

ynf.selectLimit = 10;

ynf.selectScrollWidth = 15;

ynf.css3Resize = false;

ynf.niceText = function(pTarget){
	var makeNice = function(niceTarget){
		if(YAHOO.env.ua.ie == 6){
			YAHOO.util.Dom.addClass(niceTarget, "ynf-ie6-text");
			var oWrap = document.createElement("span");
			oWrap.className = "ynf-ie6-text-wrap";
			YAHOO.util.Dom.insertBefore(oWrap, niceTarget);
			oWrap.appendChild(niceTarget);
		}
		var oIMG = document.createElement("img");
		oIMG.src = ynf.img + "blank.gif";
		oIMG.alt = niceTarget.name;
		oIMG.className = "ynf-text";
		YAHOO.util.Dom.insertAfter(oIMG, niceTarget);
		if(YAHOO.env.ua.ie == 7){
			YAHOO.util.Dom.addClass(oIMG, "ynf-ie7-text-adjust");
		}
		YAHOO.util.Event.addListener(niceTarget, "focus", function(){
			YAHOO.util.Dom.addClass(oIMG, "ynf-text-focus");
			if(YAHOO.env.ua.ie == 6){
				YAHOO.util.Dom.addClass(oWrap, "ynf-ie6-text-wrap-focus");
			} else if(YAHOO.env.ua.ie == 7){
				YAHOO.util.Dom.addClass(niceTarget, "ynf-ie7-text-focus");
			}
		});
		YAHOO.util.Event.addListener(niceTarget, "blur", function(){
			YAHOO.util.Dom.removeClass(oIMG, "ynf-text-focus");
			if(YAHOO.env.ua.ie == 6){
				YAHOO.util.Dom.removeClass(oWrap, "ynf-ie6-text-wrap-focus");
			} else if(YAHOO.env.ua.ie == 7){
				YAHOO.util.Dom.removeClass(niceTarget, "ynf-ie7-text-focus");
			}
		});
	}; // makeNice()
	if(typeof(pTarget) == "string"){
		var oTarget = document.getElementById(pTarget);
		makeNice(oTarget);
	} else if(pTarget.nodeName.toUpperCase() == "INPUT" && pTarget.getAttribute("type") == "text"){
		makeNice(pTarget);
	} else if(typeof(pTarget) == "object"){
		for(var i=0; i<pTarget.length; i++){
			makeNice(pTarget[i]);
		}
	}
}; // ynf.niceText()

ynf.niceTextarea = function(pTarget){
	var makeNice = function(niceTarget){
		var oFieldset = document.createElement("fieldset");
		oFieldset.className = "ynf-textarea-fieldset";
		YAHOO.util.Dom.insertBefore(oFieldset, niceTarget);
		oFieldset.appendChild(niceTarget);
		if(ynf.css3Resize){
			YAHOO.util.Dom.setStyle(niceTarget, "max-width", niceTarget.parentNode.parentNode.offsetWidth - ynf.cornerRadius + "px");
			YAHOO.util.Dom.setStyle(niceTarget, "max-height", "490px");
			YAHOO.util.Dom.addClass(niceTarget, "ynf-textarea-resize");
			// Webkit has some odd multiple background issues, so we need a wrapper.
			var oResizeWrapper = document.createElement("fieldset");
			oResizeWrapper.className = "ynf-textarea-resize-wrapper";
			YAHOO.util.Dom.insertBefore(oResizeWrapper, niceTarget);
			oResizeWrapper.appendChild(niceTarget);
			var oIMG = document.createElement("img");
			oIMG.src = ynf.img + "blank.gif";
			oIMG.alt = niceTarget.name;
			oIMG.width = ynf.cornerRadius;
			oIMG.height = ynf.cornerRadius;
			oIMG.className = "ynf-textarea-corner";
			oResizeWrapper.appendChild(oIMG);
			var oClear = document.createElement("br");
			oClear.className = "ynf-clear";
			oFieldset.appendChild(oClear);
			YAHOO.util.Event.addListener(niceTarget, "focus", function(){
				YAHOO.util.Dom.addClass(oResizeWrapper, "ynf-textarea-resize-wrapper-focus");
				YAHOO.util.Dom.addClass(oIMG, "ynf-textarea-corner-focus");
			});
			YAHOO.util.Event.addListener(niceTarget, "blur", function(){
				YAHOO.util.Dom.removeClass(oResizeWrapper, "ynf-textarea-resize-wrapper-focus");
				YAHOO.util.Dom.removeClass(oIMG, "ynf-textarea-corner-focus");
			});
		} else {
			if(YAHOO.env.ua.ie == 6 || YAHOO.env.ua.ie == 7){
				YAHOO.util.Dom.setStyle(oFieldset, "display", "inline");
			}
			YAHOO.util.Dom.setStyle(niceTarget, "width", niceTarget.offsetWidth - ynf.cornerRadius + "px");
			YAHOO.util.Dom.setStyle(niceTarget, "height", niceTarget.offsetHeight - ynf.cornerRadius + "px");
			var oIMG = document.createElement("img");
			oIMG.src = ynf.img + "blank.gif";
			oIMG.alt = niceTarget.name;
			oIMG.width = ynf.cornerRadius;
			oIMG.height = niceTarget.offsetHeight;
			oIMG.className = "ynf-textarea-right";
			oFieldset.appendChild(oIMG);
			var oBR = document.createElement("br");
			oFieldset.appendChild(oBR);
			var oIMG2 = document.createElement("img");
			oIMG2.src = ynf.img + "blank.gif";
			oIMG2.alt = niceTarget.name;
			oIMG2.width = niceTarget.offsetWidth;
			oIMG2.height = ynf.cornerRadius;
			oIMG2.className = "ynf-textarea-bottom";
			oFieldset.appendChild(oIMG2);
			var oIMG3 = document.createElement("img");
			oIMG3.src = ynf.img + "blank.gif";
			oIMG3.alt = niceTarget.name;
			oIMG3.width = ynf.cornerRadius;
			oIMG3.height = ynf.cornerRadius;
			oIMG3.className = "ynf-textarea-corner";
			oFieldset.appendChild(oIMG3);
			if(YAHOO.env.ua.ie == 6 || YAHOO.env.ua.ie == 7){
				YAHOO.util.Dom.addClass(oIMG2, "ynf-ie6-textarea-image");
				YAHOO.util.Dom.addClass(oIMG3, "ynf-ie6-textarea-image");
				YAHOO.util.Event.addListener(niceTarget, "focus", function(){
					YAHOO.util.Dom.addClass(niceTarget, "ynf-ie6-textarea-focus");
				});
				YAHOO.util.Event.addListener(niceTarget, "blur", function(){
					YAHOO.util.Dom.removeClass(niceTarget, "ynf-ie6-textarea-focus");
				});
			}
			YAHOO.util.Event.addListener(niceTarget, "focus", function(){
				YAHOO.util.Dom.addClass(oIMG, "ynf-textarea-right-focus");
				YAHOO.util.Dom.addClass(oIMG2, "ynf-textarea-bottom-focus");
				YAHOO.util.Dom.addClass(oIMG3, "ynf-textarea-corner-focus");
			});
			YAHOO.util.Event.addListener(niceTarget, "blur", function(){
				YAHOO.util.Dom.removeClass(oIMG, "ynf-textarea-right-focus");
				YAHOO.util.Dom.removeClass(oIMG2, "ynf-textarea-bottom-focus");
				YAHOO.util.Dom.removeClass(oIMG3, "ynf-textarea-corner-focus");
			});
		} // if(ynf.css3Resize)
		oFieldset.id = "ynf-" + niceTarget.name;
	}; // makeNice()
	if(typeof(pTarget) == "string"){
		var oTarget = document.getElementById(pTarget);
		makeNice(oTarget);
	} else if(pTarget.nodeName.toUpperCase() == "TEXTAREA"){
		makeNice(pTarget);
	} else if(typeof(pTarget) == "object"){
		for(var i=0; i<pTarget.length; i++){
			makeNice(pTarget[i]);
		}
	}
}; // ynf.niceTextarea()

ynf.niceCheckbox = function(pTarget){
	var makeNice = function(niceTarget){
		if(YAHOO.env.ua.ie == 6){
			YAHOO.util.Dom.setStyle(niceTarget, "display", "none");
		}
		var oA = document.createElement("a");
		oA.href = "javascript:void(0);";
		oA.className = "ynf-checkbox";
		var oIMG = document.createElement("img");
		oIMG.src = ynf.img + "blank.gif";
		oIMG.alt = niceTarget.name;
		oA.appendChild(oIMG);
		YAHOO.util.Dom.insertAfter(oA, niceTarget);
		YAHOO.util.Event.addListener(oA, "mouseover", function(){
			if(niceTarget.checked == false){
				YAHOO.util.Dom.addClass(oA, "ynf-checkbox-hover");
			}
		});
		YAHOO.util.Event.addListener(oA, "mouseout", function(){
			if(niceTarget.checked == false){
				YAHOO.util.Dom.removeClass(oA, "ynf-checkbox-hover");
			}
		});
		YAHOO.util.Event.addListener(oA, "click", function(){
			if(niceTarget.checked == false){
				YAHOO.util.Dom.addClass(oA, "ynf-checkbox-focus");
			} else {
				YAHOO.util.Dom.removeClass(oA, "ynf-checkbox-focus");
			}
			niceTarget.click();
		});
		if(niceTarget.id != ""){
			var oLabel = YAHOO.util.Dom.getElementsBy(function(oElement){
				if(oElement.htmlFor == niceTarget.id){
					return true;
				} else {
					return false;
				}
			}, "label")[0];
			YAHOO.util.Event.addListener(oLabel, "click", function(e){
				YAHOO.util.Event.preventDefault(e);
				if(niceTarget.checked == false){
					YAHOO.util.Dom.addClass(oA, "ynf-checkbox-focus");
				} else {
					YAHOO.util.Dom.removeClass(oA, "ynf-checkbox-focus");
				}
				niceTarget.click();
			});
		}
	}; // makeNice()
	if(typeof(pTarget) == "string"){
		var oTarget = document.getElementById(pTarget);
		makeNice(oTarget);
	} else if(pTarget.nodeName.toUpperCase() == "INPUT" && pTarget.getAttribute("type") == "checkbox"){
		makeNice(pTarget);
	} else if(typeof(pTarget) == "object"){
		for(var i=0; i<pTarget.length; i++){
			makeNice(pTarget[i]);
		}
	}
}; // ynf.niceCheckbox()

ynf.niceRadio = function(pTarget){
	var makeNice = function(niceTarget){
		if(YAHOO.env.ua.ie == 6){
			YAHOO.util.Dom.setStyle(niceTarget, "display", "none");
		}
		var oA = document.createElement("a");
		oA.href = "javascript:void(0);";
		oA.className = "ynf-radio " + niceTarget.name;
		var oIMG = document.createElement("img");
		oIMG.src = ynf.img + "blank.gif";
		oIMG.alt = niceTarget.name;
		oA.appendChild(oIMG);
		YAHOO.util.Dom.insertAfter(oA, niceTarget);
		YAHOO.util.Event.addListener(oA, "mouseover", function(){
			if(niceTarget.checked == false){
				YAHOO.util.Dom.addClass(oA, "ynf-radio-hover");
			}
		});
		YAHOO.util.Event.addListener(oA, "mouseout", function(){
			if(niceTarget.checked == false){
				YAHOO.util.Dom.removeClass(oA, "ynf-radio-hover");
			}
		});
		YAHOO.util.Event.addListener(oA, "click", function(){
			var oForm = YAHOO.util.Dom.getAncestorByTagName(niceTarget, "form");
			var oRadioLinks = YAHOO.util.Dom.getElementsByClassName(niceTarget.name, "a", oForm);
			for(var i=0; i<oForm[niceTarget.name].length; i++){
				oForm[niceTarget.name][i].checked = false;
			}
			for(var i=0; i<oRadioLinks.length; i++){
				YAHOO.util.Dom.removeClass(oRadioLinks[i], "ynf-radio-focus");
			}
			niceTarget.click();
			YAHOO.util.Dom.addClass(oA, "ynf-radio-focus");
		});
		if(niceTarget.id != ""){
			var oLabel = YAHOO.util.Dom.getElementsBy(function(oElement){
				if(oElement.htmlFor == niceTarget.id){
					return true;
				} else {
					return false;
				}
			}, "label")[0];
			YAHOO.util.Event.addListener(oLabel, "click", function(e){
				var oForm = YAHOO.util.Dom.getAncestorByTagName(niceTarget, "form");
				var oRadioLinks = YAHOO.util.Dom.getElementsByClassName(niceTarget.name, "a", oForm);
				for(var i=0; i<oForm[niceTarget.name].length; i++){
					oForm[niceTarget.name][i].checked = false;
				}
				for(var i=0; i<oRadioLinks.length; i++){
					YAHOO.util.Dom.removeClass(oRadioLinks[i], "ynf-radio-focus");
				}
				niceTarget.click();
				YAHOO.util.Dom.addClass(oA, "ynf-radio-focus");
			});
		}
	}; // makeNice()
	if(typeof(pTarget) == "string"){
		var oTarget = document.getElementById(pTarget);
		makeNice(oTarget);
	} else if(pTarget.nodeName.toUpperCase() == "INPUT" && pTarget.getAttribute("type") == "radio"){
		makeNice(pTarget);
	} else if(typeof(pTarget) == "object"){
		for(var i=0; i<pTarget.length; i++){
			makeNice(pTarget[i]);
		}
	}
}; // ynf.niceRadio()

ynf.niceButton = function(pTarget){
	var makeNice = function(niceTarget){
		if(YAHOO.env.ua.ie == 6){
			YAHOO.util.Dom.setStyle(niceTarget, "display", "none");
		}
		var oA = document.createElement("a");
		oA.href = "javascript:void(0);";
		oA.className = "ynf-button";
		if(niceTarget.getAttribute("value") == null || niceTarget.getAttribute("value") == ""){
			oA.innerHTML = niceTarget.innerHTML;
		} else {
			oA.innerHTML = niceTarget.getAttribute("value");
		}
		if(YAHOO.env.ua.ie == 6){
			YAHOO.util.Dom.addClass(oA, "ynf-ie6-button-fix");
			oA.innerHTML = '<span>' + oA.innerHTML + '</span>';
		}
		var oIMG = document.createElement("img");
		oIMG.src = ynf.img + "blank.gif";
		oIMG.alt = "";
		oIMG.width = ynf.cornerRadius;
		oIMG.height = ynf.niceHeight;
		oIMG.className = "ynf-button-right";
		oA.appendChild(oIMG);
		YAHOO.util.Dom.insertAfter(oA, niceTarget);
		YAHOO.util.Event.addListener(oA, "click", function(){
			niceTarget.click();
			return false;
		});
		if(niceTarget.id != ""){
			oA.id = "ynf-" + niceTarget.id;
		}
	}; // makeNice()
	if(typeof(pTarget) == "string"){
		var oTarget = document.getElementById(pTarget);
		makeNice(oTarget);
	} else if(pTarget.nodeName.toUpperCase() == "BUTTON" || pTarget.nodeName.toUpperCase() == "INPUT"){
		makeNice(pTarget);
	} else if(typeof(pTarget) == "object"){
		for(var i=0; i<pTarget.length; i++){
			makeNice(pTarget[i]);
		}
	}
}; // ynf.niceButton()

ynf.niceSelect = function(pTarget){
	var makeNice = function(niceTarget){
		niceTarget.active = false;
		niceTarget.selectChange = new YAHOO.util.CustomEvent("selectChange", niceTarget);
		var oDiv = document.createElement("div");
		oDiv.className = "ynf-select-wrapper";
		var oA = document.createElement("a");
		oA.href = "javascript:void(0);";
		oA.className = "ynf-select-button";
		oDiv.appendChild(oA);
		var oSpan = document.createElement("span");
		oA.appendChild(oSpan);
		oSpan.innerHTML = niceTarget.options[0].innerHTML;
		var oIMG = document.createElement("img");
		oIMG.src = ynf.img + "blank.gif";
		oIMG.alt = niceTarget.name;
		oIMG.width = ynf.selectArrow;
		oIMG.height = ynf.niceHeight;
		oIMG.className = "ynf-button-right";
		oA.appendChild(oIMG);
		YAHOO.util.Dom.insertAfter(oDiv, niceTarget);
		var oOptionsWrap = document.createElement("div");
		oOptionsWrap.className = "ynf-options-wrapper";
		oDiv.appendChild(oOptionsWrap);
		var oOptionsContainer = document.createElement("div");
		oOptionsContainer.className = "ynf-options-container";
		oOptionsWrap.appendChild(oOptionsContainer);
		var oUL = document.createElement("ul");
		oOptionsContainer.appendChild(oUL);
		var oIMG2 = document.createElement("img");
		oIMG2.src = ynf.img + "blank.gif";
		oIMG2.alt = niceTarget.name;
		oIMG2.width = ynf.cornerRadius;
		oIMG2.height = ynf.cornerRadius;
		oIMG2.className = "ynf-dropdown-left";
		oOptionsContainer.appendChild(oIMG2);
		var oIMG3 = document.createElement("img");
		oIMG3.src = ynf.img + "blank.gif";
		oIMG3.alt = niceTarget.name;
		oIMG3.width = ynf.cornerRadius;
		oIMG3.height = ynf.cornerRadius;
		oIMG3.className = "ynf-dropdown-right";
		oOptionsContainer.appendChild(oIMG3);
		var oLongest = 0;
		var oOperaFix = 0;
		var oLastLink;
		for(var i=0; i<niceTarget.options.length; i++){
			var oLI = document.createElement("li");
			oUL.appendChild(oLI);
			var oLIA = document.createElement("a");
			oLIA.href = "javascript:void(0);";
			oLIA.rel = niceTarget.options[i].value;
			oLIA.innerHTML = niceTarget.options[i].innerHTML;
			oLI.appendChild(oLIA);
			oLastLink = oLIA;
			if(oLIA.offsetWidth > oLongest){
				oLongest = oLIA.offsetWidth;
			}
			if(parseInt(YAHOO.env.ua.opera) == 9){
				// Say it ain't so Opera!!
				if(oLIA.firstChild.length > oOperaFix){
					oOperaFix = oLIA.firstChild.length
				}
			}
		}
		if(parseInt(YAHOO.env.ua.opera) == 9){
			// Opera 9 sees all the links as 35px long.
			// The following is a rough approximation based on the longest string.
			oLongest = ((parseInt(YAHOO.util.Dom.getStyle(oLastLink, "font-size")) / 2) * oOperaFix) + (ynf.cornerRadius * 2);
		}
		YAHOO.util.Dom.setStyle(oDiv, "width", oLongest + ynf.selectArrow + (ynf.cornerRadius * 2) + "px");
		YAHOO.util.Dom.setStyle(oOptionsWrap, "width", oLongest + ynf.cornerRadius + "px");
		if(niceTarget.options.length > ynf.selectLimit){
			YAHOO.util.Dom.setStyle(oOptionsContainer, "height", (oLastLink.offsetHeight * ynf.selectLimit) + "px");
			YAHOO.util.Dom.setStyle(oOptionsContainer, "overflow-x", "hidden");
			YAHOO.util.Dom.setStyle(oOptionsContainer, "overflow-y", "scroll");
			YAHOO.util.Dom.setStyle(oOptionsWrap, "width", parseInt(YAHOO.util.Dom.getStyle(oOptionsWrap, "width")) + ynf.selectScrollWidth + "px");
			YAHOO.util.Dom.setStyle(oOptionsWrap, "margin-right", -(ynf.cornerRadius) + "px");
			YAHOO.util.Dom.setStyle([oIMG2, oIMG3], "display", "none");
		}
		if(YAHOO.env.ua.ie == 6 || YAHOO.env.ua.ie == 7){
			YAHOO.util.Dom.addClass(oA, "ynf-ie6-select-fix");
			YAHOO.util.Dom.addClass(oOptionsWrap, "ynf-ie6-select-fix");
			YAHOO.util.Dom.setStyle(oDiv, "display", "inline");
			var oIE6IMG = document.createElement("img");
			oIE6IMG.src = ynf.img + "blank.gif";
			oIE6IMG.alt = niceTarget.name;
			oIE6IMG.width = 1;
			oIE6IMG.height = ynf.niceHeight;
			oIE6IMG.className = "ynf-ie6-select-fix";
			oA.appendChild(oIE6IMG);
			var oIE6As = oUL.getElementsByTagName("a");
		}
		// Animation:
		niceTarget.expand = new YAHOO.util.Anim(oOptionsWrap, {
				height: { by: oOptionsContainer.offsetHeight },
				opacity: { to: 1 }
			}, ynf.selectSpeed, YAHOO.util.Easing.easeOut);
		niceTarget.collapse = new YAHOO.util.Anim(oOptionsWrap, {
				height: { to: 0 },
				opacity: { to: 0 }
			}, ynf.selectSpeed, YAHOO.util.Easing.easeOut);
		niceTarget.collapse.onComplete.subscribe(function(){
			YAHOO.util.Dom.removeClass(oDiv, "ynf-z");
		});
		YAHOO.util.Event.addListener(oA, "click", function(){
			if(niceTarget.active == false){
				niceTarget.active = true;
				YAHOO.util.Dom.addClass(oDiv, "ynf-z");
				if(YAHOO.env.ua.gecko > 1 && YAHOO.env.ua.gecko < 1.9){
					// FF2 -moz-inline-stack fix:
					YAHOO.util.Dom.setX(oOptionsWrap, YAHOO.util.Dom.getX(oDiv) + ynf.cornerRadius);
					YAHOO.util.Dom.setY(oOptionsWrap, YAHOO.util.Dom.getY(oDiv) + ynf.niceHeight);
				}
				niceTarget.expand.animate();
			}
		});
		YAHOO.util.Event.addListener(oDiv, "mouseover", function(){
			if(typeof(niceTarget.timer) != "undefined"){
				clearTimeout(niceTarget.timer);
			}
		});
		YAHOO.util.Event.addListener(oDiv, "mouseout", function(){
			niceTarget.timer = setTimeout(function(){
				// Giving Layout to the links breaks everything,
				// while no Layout leads to early collapse,
				// so IE users must choose an option.
				if(niceTarget.active == true && YAHOO.env.ua.ie != 6 && YAHOO.env.ua.ie != 7){
					niceTarget.active = false;
					niceTarget.collapse.animate();
				}
			}, ynf.selectTimer * 1000);
		});
		var oULAs = oUL.getElementsByTagName("a");
		YAHOO.util.Event.addListener(oULAs, "click", function(e){
			var oTarget = YAHOO.util.Event.getTarget(e);
			niceTarget.active = false;
			niceTarget.collapse.animate();
			oSpan.removeChild(oSpan.childNodes[0]);
			oSpan.appendChild(document.createTextNode(oTarget.innerHTML));
			niceTarget.value = oTarget.rel;
			niceTarget.selectChange.fire(niceTarget);
			if(typeof(niceTarget.onchange) == "function"){
				niceTarget.onchange();
			}
		});
		oDiv.id = "ynf-" + niceTarget.name;
	}; // makeNice()
	if(typeof(pTarget) == "string"){
		var oTarget = document.getElementById(pTarget);
		makeNice(oTarget);
	} else if(pTarget.nodeName.toUpperCase() == "SELECT"){
		makeNice(pTarget);
	} else if(typeof(pTarget) == "object"){
		for(var i=0; i<pTarget.length; i++){
			makeNice(pTarget[i]);
		}
	}
}; // ynf.niceSelect()

ynf.renderArray = function(pArray){
	for(var i=0; i<pArray.length; i++){
		if(pArray[i].nodeName.toUpperCase() == "INPUT"){
			if(pArray[i].getAttribute("type") == "text"){
				ynf.niceText(pArray[i]);
			} else if(pArray[i].getAttribute("type") == "checkbox"){
				ynf.niceCheckbox(pArray[i]);
			} else if(pArray[i].getAttribute("type") == "radio"){
				ynf.niceRadio(pArray[i]);
			} else if(pArray[i].getAttribute("type") == "submit" || pArray[i].getAttribute("type") == "button"){
				ynf.niceButton(pArray[i]);
			}
		} else if(pArray[i].nodeName.toUpperCase() == "TEXTAREA"){
			ynf.niceTextarea(pArray[i]);
		} else if(pArray[i].nodeName.toUpperCase() == "BUTTON"){
			ynf.niceButton(pArray[i]);
		} else if(pArray[i].nodeName.toUpperCase() == "SELECT"){
			ynf.niceSelect(pArray[i]);
		}
	}
}; // ynf.renderArray()

ynf.renderForm = function(pForm){
	var oInputs = pForm.getElementsByTagName("input");
	var oTextareas = pForm.getElementsByTagName("textarea");
	var oButtons = pForm.getElementsByTagName("button");
	var oSelects = pForm.getElementsByTagName("select");
	ynf.renderArray(oInputs);
	ynf.renderArray(oTextareas);
	ynf.renderArray(oButtons);
	ynf.renderArray(oSelects);
}; // ynf.renderForm()

ynf.init = function(){
	if(typeof(document.documentElement.style.resize) == "string"){
		ynf.css3Resize = true;
	}
	ynf.forms = YAHOO.util.Dom.getElementsByClassName("ynf", "form");
	for(var i=0; i<ynf.forms.length; i++){
		ynf.renderForm(ynf.forms[i]);
	}
}; // ynf.init()

YAHOO.util.Event.onDOMReady(ynf.init);

})();
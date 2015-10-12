// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
 (function ($, window, document, undefined) {

    "use strict";

    // undefined is used here as the undefined global variable in ECMAScript 3 is
    // mutable (ie. it can be changed by someone else). undefined isn't really being
    // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
    // can no longer be modified.

    // window and document are passed through as local variable rather than global
    // as this (slightly) quickens the resolution process and can be more efficiently
    // minified (especially when both are regularly referenced in your plugin).

    // Create the defaults once
    var pluginName = "MR_ParcelShopPicker",
            defaults = {
                Target: "",                             // (Obligatoire)    Selecteur JQuery de l'élément dans lequel sera renvoyé l'ID du Point Relais sélectionné (généralement un champ input hidden)
                TargetDisplay: "",                      // (Facultatif)     Selecteur JQuery de l'élément dans lequel sera renvoyé l'ID du Point Relais sélectionné (secondaire pour affichage)
                TargetDisplayInfoPR: "",                // (Facultatif)     Selecteur JQuery de l'élément dans lequel seront renvoyé les coordonnées complètes de la selection de l'utilisateur
                Brand: "",                              // (Obligatoire)    Le code client Mondial Relay
                Country: "FR",                          // (Facultatif)     Code ISO 2 lettres du pays utilisé pour la recherche
                AllowedCountries: "",                   // (Facultatif)     Liste des pays selectionnable par l'utilisateur pour la recherche (codes ISO 2 lettres séparés par des virgules)
                PostCode: "",                           // (Facultatif)     Code postal pour lancer une recherche par défaut
                EnableGeolocalisatedSearch: true,       // (Facultatif)     Active ou non la possibilité d'effectuer la recherche sur la position courante (demande au navigateur)
                ColLivMod: "24R",                       // (Facultatif)     Permet de filtrer les Points Relais selon le mode de livraison utilisé (Point Relais L (24R), Xl (24L), XXL (24X)) référez vous à votre contrat pour plus d'informations
                Weight: "",                             // (Facultatif)     Permet de filtrer les Points Relais selon le Poids (en grammes) du colis à livrer
                Service: "",                            // (Facultatif)     Permet de filtrer les Points Relais selon les services proposés
                NbResults: "7",                         // (Facultatif)     Nombre de Point Relais à renvoyer
                SearchDelay: "",                        // (Facultatif)     Permet de spécifier le nombre de jour entre la recheche et la dépose du colis dans notre réseau. Cette option permet de filtrer les Point Relais qui seraient éventuellement en congés au moment de la livraison
                SearchFar: "75",                        // (Facultatif)     Permet de limiter la recherche des Points Relais à une distance maximum
                CSS: "1",                               // (Facultatif)     Permet de spécifier que vous souhaitez utiliser votre propre feuille de style CSS lorsque vous lui donnez la valeur "0"
                MapScrollWheel: false,                  // (Facultatif)     Active ou non le zoom on scroll sur la carte des résultats
                MapStreetView: false,                   // (Facultatif)     Active ou non le mode Street View sur la carte des résultats (attention aux quotas imposés par Google)
                ShowResultsOnMap: true,                 // (Facultatif)     Active ou non l'affichage des résultats sur une carte
                UseSSL: true,                           // (Facultatif)     Communique avec les serveurs Mondial Relay en HTTPS
                ServiceUrl: 'widget.mondialrelay.com',  // (Facultatif)     Permet de redéfinir le service fournisseur de données
                OnParcelShopSelected: null,             // (Facultatif)     Fonction de callback à la selection d'un Point Relais, le paramètre Data contient un objet avec les informations du Point Relais
                OnNoResultReturned: null,               // (facultatif)     Fonction de callback lorsqu'aucun résultat n'a été trouvé, le paramètre Data contient les données de recheche.
                OnSearchSuccess: null,                  // (facultsatif)     Fonction de callback lorsqu'une recherche retourne des résultats
                DisplayMapInfo: true
            };

    // The actual plugin constructor
    function MR_ParcelShopPicker(element, options) {
        this.element = element;
        // jQuery has an extend method which merges the contents of two or
        // more objects, storing the result in the first object. The first object
        // is generally empty as we don't want to alter the default options for
        // future instances of the plugin
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.ashx = 'service2_3.ashx';
        this.svc = 'services/parcelshop-picker.svc';
        this.w_name = 'parcelshop-picker/v3_2';
        this.sw_url = 'widget.mondialrelay.com';
        this.img_url = 'www.mondialrelay.com';
        this.bounds = {};
        this.map = {};
        this.overlays = [];
        this.InfoWindow = null;
        this.container = {};
        this.callback = null;
        this.mapLoaded = {};
        this.containerId = null;
        this.params = null;
        this.mapId = null;
        this.protocol = 'https://';

        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend(MR_ParcelShopPicker.prototype, {
        init: function () {
            // Place initialization logic here
            // You already have access to the DOM element and
            // the options via the instance, e.g. this.element
            // and this.settings
            // you can add more functions like the one below and
            // call them like so: this.yourOtherFunction(this.element, this.settings).
            if (this.settings.UseSSL) {
				this.protocol = 'https://';
            } else {
                this.protocol = 'http://';
            }

            if (!jQuery(this.element).attr("id")) {
                jQuery(this.element).attr("id", "MRParcelShopPicker_" + Math.floor((Math.random() * 10000000) + 1))
            }

            this.containerId = jQuery(this.element).attr("id")

            if (this.settings.CSS != "0") {
                this.MR_loadjscssfile(this.protocol + this.sw_url + "/" + this.w_name + "/css/style.min.css", "css");
            }
            this.container = this.element;
            this.loadhtml(
				jQuery(this.element),
				this.protocol + this.sw_url + "/" + this.w_name + "/services/widget.aspx?allowedCountries=" + this.settings.AllowedCountries + "&Country=" + this.settings.Country + "&UseSSL=" + this.settings.UseSSL + "&Brand=" + this.settings.Brand + "&Container=" + this.containerId,
				function () {
                  
				    this.MR_Widget_Init(this.settings);
				}
			);

         
            jQuery(this.element).bind("FocusOnMap", function (evt, id) {
             

                jQuery.data(this, "plugin_" + pluginName).MR_FocusOnMap(id)
            });
            jQuery(this.element).bind("TabSelect", function (evt, id) {
                jQuery.data(this, "plugin_" + pluginName).MR_tabselect(id)
            });
            jQuery(this.element).bind("MR_RebindMap", function (evt) {
                jQuery.data(this, "plugin_" + pluginName).MR_RebindMap()
            });
            jQuery(this.element).bind("MR_SetParams", function (evt, prms) {
                jQuery.data(this, "plugin_" + pluginName).MR_SetParams(prms)
            });
            jQuery(this.element).bind("MR_DoSearch", function (evt, postcode, country) {
               
                jQuery.data(this, "plugin_" + pluginName).MR_DoSearch(postcode , country)
            });

    
        },

        jsonpcall: function (fn, paramArray, callbackFn) {
            $.ajax({
                context : this,
                url: this.protocol + this.sw_url + '/' + fn,
                jsonp: "method",
                dataType: "jsonp",
                data:  paramArray,
                success: callbackFn
            });

        },

        loadhtml: function (container, urlraw, callback) {
            var urlselector = (urlraw).split(" ", 1);
            var url = urlselector[0];
            var selector = urlraw.substring(urlraw.indexOf(' ') + 1, urlraw.length);
            this.container = container;
            this.callback = callback;
            this.jsonpcall(this.ashx, { downloadurl: (url), container : container.attr("id") },
				function (msg) {
				    // gets the contents of the Html in the 'msg'
				    // todo: apply selector
				    jQuery("#"+msg.container).html(msg.html);
				    if (jQuery.isFunction(this.callback)) {
				        this.callback(msg.container);
				    }
				});
        },

        Manage_Response: function (result, container, Target, TargetDisplay, TargetDisplayInfoPR) {
            if (result.PRList == null) {
                if (this.params.OnNoResultReturned) {
                    this.params.OnNoResultReturned();
                }
            } else {

                for (var i = 0; i < result.PRList.length; i++) {
                    result.PRList[i].Letter = String.fromCharCode("A".charCodeAt(0) + i);
                }

                if (this.params.OnSearchSuccess) {
                    this.params.OnSearchSuccess(result);
                }
            }
            if (result.Error == null) {
                this.container.find(".MRW-Results").slideDown('slow');
                this.container.find(".MRW-RList").html(result.Value).show();
                if (this.params.ShowResultsOnMap) {
                    // Ajout des points sur la google map
                    if (!this.mapLoaded[this.mapId]) {
                        this.MR_LoadMap(this.params);
                        this.mapLoaded[this.mapId] = true;
                    }

                    // Supprime le contenu de la carte
                    this.MR_clearOverlays();

                    // Boucle sur les Points Relais
                    for (var i = 0; i < result.PRList.length; i++) {
                        // Ajout d'un marker pour chaque Point Relais

                        this.MR_AddGmapMarker(
								this.mapLoaded[this.mapId],
								new google.maps.LatLng(result.PRList[i].Lat.replace(',', '.'), result.PRList[i].Long.replace(',', '.')),
								result.PRList[i],
								i,
								this.sw_url
							);

                    }

                    // Redimentionne la carte
                    this.map[this.mapId].fitBounds(this.bounds[this.mapId]);

                    // AutoSelect
                    if (this.params.AutoSelect) {
                        this.MR_FocusOnMaker(this.params.AutoSelect);
                    }
                } else {
                    jQuery('#' + this.mapId , this.container).html("");
                    for (var i = 0; i < result.PRList.length; i++) {
                        jQuery('#' + this.mapId, this.container).append(this.MR_BuildParcelShopDetails(result.PRList[i]));
                        jQuery.data(jQuery('#' + this.mapId +' > div:last-child')[0], "ParcelShop", result.PRList[i]);
                        jQuery('#' + this.mapId + ' > div:last-child').bind("select", function () { this.MR_SelectParcelShop(jQuery.data(jQuery(this)[0], "ParcelShop")); });
                        jQuery('#' + this.mapId + ' > div', this.container).hide();
                    }
                }

            } else {
                this.container.find(".MRW-Results").hide();
                this.container.find(".MRW-Errors").html(result.Error).slideDown("slow");
            }

            this.container.find('.progressBar').hide();

            // Gestion du hover sur les items
            this.container.find('.PR-List-Item').on("mouseover", function () {
                jQuery(this).addClass("PR-hover");
            });
            this.container.find('.PR-List-Item').on("mouseout", function () {
                jQuery(this).removeClass("PR-hover");
            });

        },

        MR_Widget_Call: function (container, Target, TargetDisplay, TargetDisplayInfoPR, UseMyPosition) {
            this.container.find(".MRW-Errors").hide();
            this.container.find('.progressBar').show();
            this.container.find(".MRW-Errors").html("");

            var a0 = this.settings.Brand;
            var a1 = this.container.find('input.Arg1')[0].value;
            var a2 = this.container.find('input.Arg2')[0].value;
            var a3 = this.params.ColLivMod;
            var a4 = this.settings.Weight;
            var a5 = this.settings.NbResults;
            var a6 = this.settings.SearchDelay;
            var a7 = this.settings.SearchFar;
            var a8 = this.settings.VacationBefore || '';
            var a9 = this.settings.VacationAfter || '';
            var a10 = this.settings.Service;

            var ins = this;

            if (UseMyPosition) {
                navigator.geolocation.getCurrentPosition(
					function (position) {
					    ins.jsonpcall(ins.w_name + "/" + ins.svc + "/SearchPR",
							{"Brand": a0 , "Country" : a1,
							    "PostCode": "", 
							    "ColLivMod": a3, 
							    "Weight": a4, 
							    "NbResults": a5, 
							    "SearchDelay": a6,
							    "SearchFar": a7,
							    "ClientContainerId": ins.containerId,
							    "VacationBefore": a8,
							    "VacationAfter": a9, 
							    "Service": a10, 
							    "Latitude": position.coords.latitude, 
							    "Longitude": position.coords.longitude},
							function (result) {
							    ins.Manage_Response(result, ins.container, Target, TargetDisplay, TargetDisplayInfoPR);
							});
					},
					function (error) {
					    alert("Erreur à l'obtention des données de géolocalisation : [" + error.code + "] " + error.message);
					},
					{
					    timeout: 1000,
					    maximumAge: 30000
					}
				);
            }
            else {
                this.jsonpcall(this.w_name + "/" + this.svc + "/SearchPR",
					{
					    "Brand": a0,
					    "Country": a1,
					    "PostCode": a2,
					    "ColLivMod": a3,
					    "Weight": a4,
					    "NbResults": a5,
					    "SearchDelay": a6,
					    "SearchFar": a7,
					    "ClientContainerId": this.containerId,
					    "VacationBefore": a8,
					    "VacationAfter": a9,
					    "Service": a10,
					    "Latitude": '',
					    "Longitude": ''
					},
					function (result) {
					    this.Manage_Response(result, this.container, Target, TargetDisplay, TargetDisplayInfoPR);
					});
            }
        },

        MR_LoadMap: function (prms) {
            var myOptions = {
                zoom: 5,
                center: new google.maps.LatLng(46.80000, 1.69000),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: false, // Flèches de direction
                rotateControl: true,
                scaleControl: true, // Mesure de distance
                scrollwheel: prms.MapScrollWheel ? prms.MapScrollWheel : false, // Zoom avec la molette de la souris
                streetViewControl: prms.MapStreetView ? prms.MapStreetView : false, // Autorisation de StreetView
                zoomControl: true // Zoom
            };
            this.map[this.mapId] = new google.maps.Map(document.getElementById(this.mapId), myOptions);
            this.bounds[this.mapId] = new google.maps.LatLngBounds();
            this.overlays[this.mapId] = [];
        },

        MR_clearOverlays: function () {
            for (var n = 0, overlay; overlay = this.overlays[this.mapId][n]; n++) {
                overlay.setMap(null);
            }
            // Clear overlays from collection
            this.overlays[this.mapId] = [];
            this.bounds[this.mapId] = new google.maps.LatLngBounds();
        },

        MR_FocusOnMaker: function (id) {
            // Boucle sur les Markers
            for (var i = 0; i < this.overlays[this.mapId].length; i++) {
                // Test de validité
                if (id == this.overlays[this.mapId][i].get("id")) {
                    this.MR_FocusOnMap(i);
                }
            }
        },

        MR_AddGmapMarker: function (map, latLng, PRI, Id, sw_url) {
            // Get the letter for the marker

            // Create the marker
            var marker = new google.maps.Marker({
                position: latLng,
                map: this.map[this.mapId],
                icon: new google.maps.MarkerImage(this.protocol + this.sw_url + "/" + this.w_name + "/css/imgs/gmaps_pr02" + PRI.Letter + ".png")
            });

           

            var ins = this;
            // Add clickListener
            if (this.settings.DisplayMapInfo) {
                google.maps.event.addListener(marker, 'click', function () {
                    // Fermeture de la fenêtre précédente
                    if (ins.InfoWindow != null) { ins.InfoWindow.close(); }

                    ins.InfoWindow = new google.maps.InfoWindow(
						{
						    content: ins.MR_BuildParcelShopDetails(PRI)
						}
					);

                    ins.InfoWindow.open(ins.map[ins.mapId], marker);
				   
                });
            }
            // Add clickListener
            google.maps.event.addListener(marker, 'click', function () {
                ins.MR_SelectParcelShop(PRI);
                ins.map[ins.mapId].setCenter(marker.getPosition());
            });

            // Add Marker to Overlays collection
            this.overlays[this.mapId].push(marker);

            // Redimentionne la carte
            this.bounds[this.mapId].extend(latLng);
            //map.fitBounds(bounds);

            return marker;
        },

        MR_SelectParcelShop: function (PRI) {
            if (PRI.Available != false) {
                jQuery(this.settings.Target).val(PRI.Pays + '-' + PRI.ID).trigger('change');
                if (this.settings.TargetDisplay) {
                    jQuery(this.settings.TargetDisplay).val(PRI.Pays + '-' + PRI.ID);
                }
                if (this.settings.TargetDisplayInfoPR) {
                    jQuery(this.settings.TargetDisplayInfoPR).html(
						  (PRI.Nom      == null ? '' : PRI.Nom      + '<br/>')
						+ (PRI.Adresse1 == null ? '' : PRI.Adresse1 + '<br/>')
						+ (PRI.Adresse2 == null ? '' : PRI.Adresse2 + '<br/>')
						+ PRI.CP + ' '
						+ PRI.Ville + ' '
						+ PRI.Pays
					);
                }

                this.container.find(".PR-Selected").removeClass("PR-Selected");
                this.container.find('.PR-Id[Value="' + PRI.Pays + '-' + PRI.ID + '"]').parent().addClass("PR-Selected");

                if (this.settings.OnParcelShopSelected) {
                    this.settings.OnParcelShopSelected(PRI)
                }
            }
        },

        MR_BuildParcelShopDetails: function (PRI) {
            var content = '<div class="InfoWindow">'
						+ '<div class="PR-Name">' + PRI.Nom + '</div>'
						+ '<div class="Tabs-Btns">'
						+ '<span class="Tabs-Btn Tabs-Btn-Selected" id="btn_01" onclick="jQuery(\'#' + this.containerId + '\').trigger(\'TabSelect\',\'01\');">' + MondialRelayLanguage.Horaires + '</span>'
						+ '<span class="Tabs-Btn" id="btn_02" onclick="jQuery(\'#' + this.containerId + '\').trigger(\'TabSelect\',\'02\');">' + MondialRelayLanguage.Photo + '</span>'
						+ '</div>'
						+ '<div class="Tabs-Tabs">'
						+ '<div class="Tabs-Tab Tabs-Tab-Selected" id="tab_01">' + PRI.HoursHtmlTable + '</div>'
						+ '<div class="Tabs-Tab" id="tab_02">'
						+ '<img src="' + this.protocol + this.img_url + '/img/dynamique/pr.aspx?id=' + PRI.Pays + this.MR_pad_left(PRI.ID, '0', 6) + '" width="182" height="112"/>'
						+ '</div>'
						+ '</div>'
						+ '</div>'
            return content;
        },

        MR_loadjscssfile: function (filename, filetype) {
            var fileref;
            if (filetype == "js") {
                fileref = document.createElement('script');
                fileref.setAttribute("type", "text/javascript");
                fileref.setAttribute("src", filename);
            }
            else if (filetype == "css") {
                fileref = document.createElement("link");
                fileref.setAttribute("rel", "stylesheet");
                fileref.setAttribute("type", "text/css");
                fileref.setAttribute("href", filename);
            }
            if (typeof fileref != "undefined") { document.getElementsByTagName("head")[0].appendChild(fileref); }
        },

        MR_pad_left: function (s, c, n) {
            if (!s || !c || s.length >= n) {
                return s;
            }

            var max = (n - s.length) / c.length;
            for (var i = 0; i < max; i++) {
                s = c + s;
            }

            return s;
        },

        MR_Widget_Init: function (prms) {
  
      
            var ins = this;
            this.params = prms;
            // Autocomplete sur le nom de ville
            var t = this.container.find('input.iArg0');
            var autoCpl = jQuery("<div>");
            this.mapId = this.container.find(".MRW-Map").attr("id")
            this.bounds[this.mapId] = [];
            this.overlays[this.mapId] = [];
            autoCpl.addClass("PR-AutoCplCity");
            autoCpl.css("width", t.width());

            this.container.find('.MRW-Search').append(autoCpl);

            this.container.find('input.Arg2').on('keydown', function (e) {
                ins.container.find('.PR-AutoCplCity').html("").slideUp("fast");
            });

            this.container.find('input.iArg0').on('keydown', function (e) {
                var keyCode = e.keyCode || e.which;

                var ia0 = ins.container.find('input.iArg0')[0].value;
                var a2 = ""; //container.find('input.Arg2')[0].value;
                var a1 = ins.container.find('input.Arg1')[0].value;

                var inp = String.fromCharCode(keyCode);
                //déplacement par les touches
                //en cas de touche fleche vers le bas 
                if (keyCode == 40) {
                    if (ins.container.find('.PR-AutoCplCity .AutoCpl-Hover').length === 0) {
                        ins.container.find('.PR-AutoCplCity div:first-child').addClass("AutoCpl-Hover");
                    } else if (ins.container.find('.AutoCpl-Hover').next().length > 0) {
                        ins.container.find('.AutoCpl-Hover').removeClass("AutoCpl-Hover").next().addClass("AutoCpl-Hover");
                    }
                }
                    //en cas de touche fleche vers le haut
                else if (keyCode == 38) {
                    if (ins.container.find('.PR-AutoCplCity .AutoCpl-Hover').length === 0) {
                        ins.container.find('.PR-AutoCplCity div:last-child').addClass("AutoCpl-Hover");
                    } else if (ins.container.find('.AutoCpl-Hover').prev().length > 0) {
                        ins.container.find('.AutoCpl-Hover').removeClass("AutoCpl-Hover").prev().addClass("AutoCpl-Hover");
                    }
                }
                    //en cas de touche entrée
                else if ((keyCode == 13 || keyCode == 9) && ins.container.find('.AutoCpl-Hover').length > 0) {
                    e.preventDefault();
                    ins.container.find('input.Arg2')[0].value = ins.container.find('.AutoCpl-Hover').attr("title");
                    ins.container.find('input.iArg0')[0].value = ins.container.find('.AutoCpl-Hover').attr("name");
                    ins.container.find('.PR-AutoCplCity').html("").slideUp("fast");
                    return;
                }
                    //pour toute autre touche de type caractère
                else if (/[a-zA-Z0-9\-_ ]/.test(inp)) {
                    ia0 = ia0 + inp;
                    if (ia0.length > 3) {
                        ins.container.find('.PR-AutoCplCity').css("top", (ins.offsetTop + 20) + "px");
                        ins.container.find('.PR-AutoCplCity').css("left", (ins.offsetLeft) + "px");

                        ins.jsonpcall(ins.w_name + "/" + ins.svc + "/AutoCPLCity",
						{ "PostCode": a2, "Country": a1, "City": ia0 },
						function (result) {
						    ins.container.find('.PR-AutoCplCity').html("");

						    for (var i = 0; i < result.Value.length; i++) {
						        var elm = jQuery("<div>");
						        elm.attr("title", result.Value[i].PostCode);
						        elm.attr("name", result.Value[i].Name);
						        elm.addClass("PR-City");

						        elm.html(result.Value[i].Name + " (" + result.Value[i].PostCode + ")");
						        ins.container.find('.PR-AutoCplCity').append(elm);
						        elm.on("click", function () {
						            ins.container.find('input.Arg2')[0].value = jQuery(this).attr("title");
						            ins.container.find('input.iArg0')[0].value = jQuery(this).attr("name");
						            ins.container.find('.PR-AutoCplCity').html("").slideUp("fast");
						        });
						    }
						    ins.container.find('.PR-AutoCplCity').slideDown("fast");
						});

                    }
                }
                else {
                    ins.container.find('.PR-AutoCplCity').html("").slideUp("fast");
                }
            });

            this.container.find('input.iArg0').on("blur", function (event) {
                if (ins.container.find('.AutoCpl-Hover').length) {
                    ins.container.find('input.Arg2')[0].value = ins.container.find('.AutoCpl-Hover').attr("title");
                    ins.container.find('input.iArg0')[0].value = ins.container.find('.AutoCpl-Hover').attr("name");
                }

            });

            
            // Fonction au click sur le bouton 'rechercher'
            this.container.find('.MRW-BtGo').on("click", function () {
                var btn = jQuery(this);
                ins.MR_Widget_Call(ins.container, ins.settings.Target, ins.settings.TargetDisplay, ins.settings.TargetDisplayInfoPR, false);
                return false;
            });

            if (!("geolocation" in navigator)) { this.params.EnableGeolocalisatedSearch = false; }
            if (this.params.EnableGeolocalisatedSearch) {
                // Fonction au click sur le bouton 'utiliser ma position'
                this.container.find('.MRW-BtGeoGo').on("click", function () {
                    var btn = jQuery(this);
                    ins.MR_Widget_Call(ins.container, ins.settings.Target, ins.settings.TargetDisplay, ins.settings.TargetDisplayInfoPR, true);
                    return false;
                });
            } else {
                this.container.find('.MRW-BtGeoGo').hide();
            }

            // Fonction au click sur la selection des pays
            this.container.find('.MRW-flag').on("click", function () {
                var btn = jQuery(this);
                ins.container.find('.MRW-fl-Select').slideDown("fast").css("top", (this.offsetTop + this.height + 2) + "px").css("left", this.offsetLeft - 3 + "px");
            });

            // Fonction au click sur la selection d'un pays
            this.container.find('.MRW-fl-Item').on("click", function () {
                var btn = jQuery(this);
                ins.container.find('.MRW-fl-Select').slideUp("fast");
                ins.container.find('.MRW-flag').attr('src', btn.find('img').attr('src'));
                ins.container.find('input.Arg1')[0].value = btn.find('img').attr('alt');
            });

            this.container.find('input.Arg0')[0].value = prms.Brand;
            this.container.find('input.Arg1')[0].value = prms.Country;
            this.container.find('input.Arg2')[0].value = prms.PostCode;
            this.container.find('input.Arg3')[0].value = prms.ColLivMod;
            this.container.find('input.Arg4')[0].value = prms.Weight;
            this.container.find('input.Arg5')[0].value = prms.NbResults;
            this.container.find('input.Arg6')[0].value = prms.SearchDelay;
            this.container.find('input.Arg7')[0].value = prms.SearchFar;
            this.container.find('input.Arg10')[0].value = prms.Service;

            if (prms.PostCode != "") { this.MR_Widget_Call(this.container, prms.Target, prms.TargetDisplay, prms.TargetDisplayInfoPR, false); }
        },

        MR_Destroy: function (Div, prms) {
            this.container = jQuery(Div);
            this.container.find('input.Arg2').unbind('keydown');
            this.container.find('input.iArg0').unbind('keydown');
            this.mapLoaded[this.mapId] = false;
        },

        MR_FocusOnMap: function (i) {
            if (this.params.ShowResultsOnMap) {
                google.maps.event.trigger(this.overlays[this.mapId][i], "click");
            } else {
                jQuery('#' + this.mapId + ' > div', this.container).hide();
                jQuery('#' + this.mapId + ' > div:nth-child(' + (i + 1) + ')', this.container).show().trigger('select');
            }
        },

        MR_RebindMap: function () {
            if (this.params == null) {
                console.info('MR_RebindMap() method has been called too early.');
            } else {
                if (this.params.ShowResultsOnMap) {
                    google.maps.event.trigger(this.map, 'resize');
                    this.map[this.mapId].fitBounds(this.bounds[this.mapId]);
                }
            }
        },

        MR_SetParams: function (params) {
            if (this.params == null) {
                console.info('MR_SetParams() method has been called too early.');
            } else {
                this.settings = jQuery.extend(this.params, params);
                this.params = jQuery.extend(this.params, params);
            }
        },

        MR_DoSearch: function (PostCode,Country) {

            this.container.find('input.Arg2').val(PostCode);
            this.container.find('input.Arg1').val(Country);
     
            this.MR_Widget_Call(this.container, this.settings.Target, this.settings.TargetDisplay, this.settings.TargetDisplayInfoPR, false);
        },

        MR_tabselect: function (tab) {
            jQuery(".Tabs-Btn-Selected", this.container).removeClass("Tabs-Btn-Selected");
            jQuery('#btn_' + tab, this.container).addClass("Tabs-Btn-Selected");
            jQuery(".Tabs-Tab-Selected", this.container).removeClass("Tabs-Tab-Selected");
            jQuery('#tab_' + tab, this.container).addClass("Tabs-Tab-Selected");
        }


    });

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    jQuery.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!jQuery.data(this, "plugin_" + pluginName)) {
                jQuery.data(this, "plugin_" + pluginName, new MR_ParcelShopPicker(this, options));
            }
        });
    };

})(jQuery, window, document);
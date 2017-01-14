<?php
/**
 * This file is used to markup the meta box aspects of the plugin.
 *
 * @since      1.0.0
 * @package    imagelinks
 * @subpackage imagelinks/admin/partials
 */
?>
<script type="text/javascript">
	var _imageLinksAppData = window.imageLinksAppData || {};
	if(_imageLinksAppData) {
		_imageLinksAppData.path = '<?php echo plugin_dir_url( dirname(dirname(__FILE__)) ); ?>';
		_imageLinksAppData.ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
		_imageLinksAppData.uploadUrl = '<?php $upload_dir = wp_upload_dir(); echo $upload_dir['baseurl']; ?>';
	}
</script>

<!-- imgl-ui-wrap -->
<div id="imgl-ui-wrap" x-ng-app="ngImageLinksApp" x-ng-controller="ngImageLinksAppController">
	<input type="hidden" id="imgl-ui-meta-image-url" name="imgl-meta-image-url" value="">
	<input type="hidden" id="imgl-ui-meta-ui-cfg" name="imgl-meta-ui-cfg" value="<?php echo get_post_meta( get_the_ID(), 'imgl-meta-ui-cfg', true ); ?>">
	<input type="hidden" id="imgl-ui-meta-imagelinks-cfg" name="imgl-meta-imagelinks-cfg" value="">
	
	
	<div id="imgl-ui-workspace" class="imgl-ui-clearfix" x-workspace x-init="appData.fn.workspace.init">
		<div id="imgl-ui-screen">
			<div id="imgl-ui-image-loading" x-ng-class="{'imgl-ui-active': appData.image.isLoading}">
				<i class="fa fa-spinner fa-pulse fa-fw"></i>
			</div>
			<div id="imgl-ui-canvas" x-ng-class="{'imgl-ui-active': appData.image.show, 'imgl-ui-target-tool': appData.targetTool}" x-canvas x-init="appData.fn.canvas.init">
				<img id="imgl-ui-canvas-image" x-ng-src="{{appData.image.show ? appData.fn.getImageFullPath(appData, appData.config) : ''}}" x-ng-style="appData.canvas.style" data-pin-nopin="true">
				<div id="imgl-ui-hotspots">
					<div x-ng-repeat="hotspot in appData.config.hotspots | isset:'isVisible'">
						<div class="imgl-ui-hotspot" x-ng-class="{'imgl-ui-active': hotspot.isSelected}" x-ng-style="hotspot.style" x-hotspot x-init="appData.fn.hotspots.init" x-data="hotspot" tabindex="1">
							<div class="imgl-ui-hotspot-label">{{hotspot.id}}</div>
							<div class="line pos-n"></div>
							<div class="line pos-e"></div>
							<div class="line pos-s"></div>
							<div class="line pos-w"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="imgl-ui-tabs">
			<div class="imgl-ui-tab" x-ng-class="{'imgl-ui-active': appData.tabPanel.general.isActive}" x-tab-panel-item x-id="general" x-init="appData.fn.tabPanelItemInit"><i class="fa fa-fw fa-cog"></i>General</div>
			<div class="imgl-ui-tab" x-ng-class="{'imgl-ui-active': appData.tabPanel.hotspots.isActive}" x-tab-panel-item x-id="hotspots" x-init="appData.fn.tabPanelItemInit"><i class="fa fa-fw fa-dot-circle-o"></i>Hotspots</div>
			<div class="imgl-ui-cmd-setimage" x-select-image x-id="image" x-init="appData.fn.selectImageInit">Set Image</div>
			<div class="imgl-ui-cmd-preview" x-ng-click="appData.fn.preview(appData);">Preview</div>
		</div>
		<div id="imgl-ui-tab-data">
			<!-- general section -->
			<div class="imgl-ui-section" x-ng-class="{'imgl-ui-active': appData.tabPanel.general.isActive}">
				<div class="imgl-ui-config">
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-folded': appData.config.foldedSections.imageUrl}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.imageUrl = !appData.config.foldedSections.imageUrl;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Set the full url for the image.</div></div>
							<div class="imgl-ui-title">Image Url</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-control">
								<input class="imgl-ui-text imgl-ui-long" type="text" x-ng-model="appData.config.imageUrl">
							</div>
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.imageUrlLocal"></div>
								<label>URL is local</label>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-folded': appData.config.foldedSections.imageSize}">
						<div class="imgl-ui-block-header"  x-ng-click="appData.config.foldedSections.imageSize = !appData.config.foldedSections.imageSize;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Set image custom width and height.</div></div>
							<div class="imgl-ui-title">Image Size</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-control">
								<select class="imgl-ui-select" x-ng-model="appData.config.imageSize">
									<option value="none">Default</option>
									<option value="fixed">Fixed Size</option>
								</select>
							</div>
							
							<div class="imgl-ui-inline-group" x-ng-if="!(appData.config.imageSize=='none')"> 
								<div class="imgl-ui-inline-group">
									<div class="imgl-ui-label">Width (px)</div>
									<div class="imgl-ui-control">
										<input class="imgl-ui-number" type="number" min="0" x-ng-model="appData.config.imageWidth">
									</div>
								</div>
								<div class="imgl-ui-inline-group">
									<div class="imgl-ui-label">Height (px)</div>
									<div class="imgl-ui-control">
										<input class="imgl-ui-number" type="number" min="0" x-ng-model="appData.config.imageHeight">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-folded': appData.config.foldedSections.theme}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.theme = !appData.config.foldedSections.theme;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Choose a theme from the list.<br><br>Note:<br>You can create your own theme too and add it in the plugin folder for later use.</div></div>
							<div class="imgl-ui-title">Theme</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-control">
								<select class="imgl-ui-select" x-ng-model="appData.config.theme">
									<option value="imgl-theme-default">default</option>
									<?php 
										$plugin_path = plugin_dir_path( dirname(dirname(__FILE__)) );
										$path = $plugin_path . 'lib/imagelinks.theme.*.css';
										$files = glob( $path );
										foreach($files as $file) {
											$file = strtolower(basename($file));
											$matches = array();
											
											if(preg_match('/^imagelinks.theme.(.*).css?/', $file, $matches)) {
												$theme = $matches[1];
												if($theme !== 'default' ) {
													echo '<option value="imgl-theme-' . $theme . '">' . $theme . '</option>';
												}
											}
										}
									?>
								</select>
							</div>
							
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.hotSpotBelowPopover"></div>
								<label>Hotspots are below the popover window</label>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-folded': appData.config.foldedSections.mobile}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.mobile = !appData.config.foldedSections.mobile;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Enable or disable the animation in the mobile browsers.</div></div>
							<div class="imgl-ui-title">Mobile Animation</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-toggle" x-ng-model="appData.config.mobile"></div>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-folded': appData.config.foldedSections.popoverCfg}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.popoverCfg = !appData.config.foldedSections.popoverCfg;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Set popover settings. They are common for all popover instances.<br><br>Note:<br>We recommend do not change the popover template without having some knowledge.</div></div>
							<div class="imgl-ui-title">Popover Settings</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-label">Show Popovers</div>
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-toggle" x-ng-model="appData.config.popover"></div>
							</div>
							
							<div class="imgl-ui-label">Popover Placement</div>
							<div class="imgl-ui-control">
								<select class="imgl-ui-select" x-ng-model="appData.config.popoverPlacement">
									<option value="top">top</option>
									<option value="bottom">bottom</option>
									<option value="left">left</option>
									<option value="right">right</option>
									<option value="top-left">top left</option>
									<option value="top-right">top right</option>
									<option value="bottom-left">bottom left</option>
									<option value="bottom-right">bottom right</option>
								</select>
							</div>
							
							<div class="imgl-ui-label">Popover Show Trigger</div>
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-control">
									<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.popoverShowTriggerHover"></div>
									<label>Hover</label>
								</div>
							</div>
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-control">
									<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.popoverShowTriggerClick"></div>
									<label>Click</label>
								</div>
							</div>
							<br>
							
							<div class="imgl-ui-label">Popover Hide Trigger</div>
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-control">
									<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.popoverHideTriggerLeave"></div>
									<label>Leave</label>
								</div>
							</div>
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-control">
									<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.popoverHideTriggerClick"></div>
									<label>Click</label>
								</div>
							</div>
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-control">
									<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.popoverHideTriggerBodyClick"></div>
									<label>Body</label>
								</div>
							</div>
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-control">
									<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.config.popoverHideTriggerManual"></div>
									<label>Manual</label>
								</div>
							</div>
							<br>
							
							<div class="imgl-ui-label">Popover Show CSS3 Class</div>
							<div class="imgl-ui-control">
								<button class="imgl-ui-button" type="button" x-select-class x-init="appData.fn.selectPopoverShowClass">GET</button>
								<input class="imgl-ui-text" type="text" x-ng-model="appData.config.popoverShowClass" x-ng-model-options="{updateOn: 'change blur'}">
							</div>
							
							<div class="imgl-ui-label">Popover Hide CSS3 Class</div>
							<div class="imgl-ui-control">
								<button class="imgl-ui-button" type="button" x-select-class x-init="appData.fn.selectPopoverHideClass">GET</button>
								<input class="imgl-ui-text" type="text" x-ng-model="appData.config.popoverHideClass" x-ng-model-options="{updateOn: 'change blur'}">
							</div>
							
							<div class="imgl-ui-label">Popover HTML Template</div>
							<div class="imgl-ui-control">
								<textarea class="imgl-ui-textarea" cols="40" rows="5" x-ng-model="appData.config.popoverTemplate"></textarea>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block"  x-ng-class="{'imgl-ui-folded': appData.config.foldedSections.customCSS}">
						<div class="imgl-ui-block-header"  x-ng-click="appData.config.foldedSections.customCSS = !appData.config.foldedSections.customCSS;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Enter any custom css you want to apply on this imagelins.<br><br>Note:<br>Please do not use <b>&lt;style&gt;...&lt;/style&gt;</b> tag with Custom CSS.</div></div>
							<div class="imgl-ui-title">Custom CSS</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-toggle" x-ng-model="appData.config.customCSS"></div>
							</div>
							
							<div class="imgl-ui-control" x-ng-if="appData.config.customCSS">
								<textarea class="imgl-ui-textarea" cols="40" rows="20" x-ng-model="appData.config.customCSSContent"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /end general section -->
			
			<!-- hotspots section -->
			<div class="imgl-ui-section" x-ng-class="{'imgl-ui-active': appData.tabPanel.hotspots.isActive}">
				<div class="imgl-ui-item-list-wrap">
					<div class="imgl-ui-item-commands">
						<div class="imgl-ui-item-command" x-ng-click="appData.fn.hotspots.add(appData)"><i class="fa fa-fw fa-plus-square"></i></div>
						<div class="imgl-ui-item-command" x-ng-click="appData.fn.hotspots.copySelected(appData)"><i class="fa fa-fw fa-clone"></i></div>
						<div class="imgl-ui-item-command" x-ng-click="appData.fn.hotspots.upSelected(appData)"><i class="fa fa-fw fa-arrow-up"></i></div>
						<div class="imgl-ui-item-command" x-ng-click="appData.fn.hotspots.downSelected(appData)"><i class="fa fa-fw fa-arrow-down"></i></div>
						<div class="imgl-ui-item-command" x-ng-click="appData.fn.hotspots.removeSelected(appData)"><i class="fa fa-fw fa-trash"></i></div>
					</div>
					<ul class="imgl-ui-item-list">
						<li class="imgl-ui-item" x-ng-repeat="hotspot in appData.config.hotspots track by hotspot.id" x-ng-class="{'imgl-ui-active': hotspot.isSelected}" x-ng-click="appData.fn.hotspots.select(appData, hotspot)">
							<span class="imgl-ui-icon"></span>
							<span class="imgl-ui-name">{{hotspot.id}}</span>
							<span class="imgl-ui-visible" x-ng-click="hotspot.isVisible=!hotspot.isVisible;" x-ng-class="{'imgl-ui-off': !hotspot.isVisible}"></span>
						</li>
					</ul>
				</div>
				<div class="imgl-ui-config">
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-folded': appData.config.foldedSections.targetTool}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.targetTool = !appData.config.foldedSections.targetTool;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Use the target tool to quick create a hotspot and it's location on the image.<br><br>When the target tool is ON click on the image and you will get a new hotspot.</div></div>
							<div class="imgl-ui-title">Target Tool State</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-toggle" x-ng-model="appData.targetTool"></div>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-hidden': !appData.hotspot.selected, 'imgl-ui-folded': appData.config.foldedSections.hotspotLocation}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.hotspotLocation = !appData.config.foldedSections.hotspotLocation;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Use this options to set the hotspot's starting x and y location.<br><br>If you want to change the location of the selected hotspot, just click on the hotspot and drag it or use arrow keys.</div></div>
							<div class="imgl-ui-title">Hotspot Location</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-label">X %</div>
								<div class="imgl-ui-control">
									<input class="imgl-ui-number" type="number" step="any" x-ng-model="appData.hotspot.selected.config.x">
								</div>
							</div>
							
							<div class="imgl-ui-inline-group">
								<div class="imgl-ui-label">Y %</div>
								<div class="imgl-ui-control">
									<input class="imgl-ui-number" type="number" step="any" x-ng-model="appData.hotspot.selected.config.y">
								</div>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-hidden': !appData.hotspot.selected, 'imgl-ui-folded': appData.config.foldedSections.hotspotCfg}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.hotspotCfg = !appData.config.foldedSections.hotspotCfg;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Use this option to set hotspot settings. You can define your own style for hotspot with images, icons, text and etc.</div></div>
							<div class="imgl-ui-title">Hotspot Settings</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-label">Hotspot Image (otherwise the plugin uses a theme icon)</div>
							<div class="imgl-ui-control">
								<div class="imgl-ui-image" x-select-image x-id="hotspot" x-init="appData.fn.selectImageInit" x-ng-class="{'imgl-ui-active': appData.hotspot.selected.config.imageUrl}">
									<div class="imgl-ui-image-data" x-ng-style="{'background-image': 'url(' + appData.fn.getImageFullPath(appData, appData.hotspot.selected.config) + ')'}"></div>
									<div class="imgl-ui-image-clear" x-ng-click="appData.hotspot.selected.config.imageUrl='';$event.stopPropagation();"></div>
								</div>
							</div>
							
							<div x-ng-if="(appData.hotspot.selected.config.imageUrl ? true : false)">
								<div class="imgl-ui-inline-group">
									<div class="imgl-ui-label">Image Custom Width (px)</div>
									<div class="imgl-ui-control">
										<input class="imgl-ui-number" type="number" min="0" x-ng-model="appData.hotspot.selected.config.imageWidth">
									</div>
								</div>
								
								<div class="imgl-ui-inline-group">
									<div class="imgl-ui-label">Image Custom Height (px)</div>
									<div class="imgl-ui-control">
										<input class="imgl-ui-number" type="number" min="0" x-ng-model="appData.hotspot.selected.config.imageHeight">
									</div>
								</div>
							</div>
							
							<div class="imgl-ui-label">Link URL</div>
							<div class="imgl-ui-control">
								<input class="imgl-ui-text imgl-ui-long" type="text" x-ng-model="appData.hotspot.selected.config.link">
							</div>
							
							<div class="imgl-ui-label">Open Link in New Window</div>
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-toggle" x-ng-model="appData.hotspot.selected.config.linkNewWindow"></div>
							</div>
							
							<div class="imgl-ui-accordion">
								<div class="imgl-ui-accordion-toggle">Advanced Options</div>
								<div class="imgl-ui-accordion-data">
									<div class="imgl-ui-label">Hotspot Custom Class Name</div>
									<div class="imgl-ui-control">
										<input class="imgl-ui-text" type="text" x-ng-model="appData.hotspot.selected.config.customClassName">
									</div>
									
									<div class="imgl-ui-label">Hotspot HTML Content</div>
									<div class="imgl-ui-control">
										<textarea class="imgl-ui-textarea" cols="40" rows="5" x-ng-model="appData.hotspot.selected.config.customContent"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="imgl-ui-block" x-ng-class="{'imgl-ui-hidden': !appData.hotspot.selected, 'imgl-ui-folded': appData.config.foldedSections.hotspotPopoverCfg}">
						<div class="imgl-ui-block-header" x-ng-click="appData.config.foldedSections.hotspotPopoverCfg = !appData.config.foldedSections.hotspotPopoverCfg;">
							<div class="imgl-ui-helper"><div class="imgl-ui-tooltip">Use this options to set popover settings.</div></div>
							<div class="imgl-ui-title">Popover Settings</div>
							<div class="imgl-ui-state"></div>
						</div>
						<div class="imgl-ui-block-data">
							<div class="imgl-ui-label">Show Popover</div>
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-toggle" x-ng-model="appData.hotspot.selected.config.popover"></div>
							</div>
							
							<div class="imgl-ui-label">Popover Content</div>
							<div class="imgl-ui-control">
								<?php 
									// Manual double binding for x-ng-model="appData.hotspot.selected.config.popoverContent"
									$settings = array(
										'wpautop' => false,
										'editor_height' => 300 // In pixels, takes precedence and has no default value
									);
									wp_editor('', 'imgluihotspotpopovercontent', $settings);
								?>
							</div>
							
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.hotspot.selected.config.popoverHtml"></div>
								<label>Popover Content is HTML</label>
							</div>
							
							<div class="imgl-ui-control">
								<div x-checkbox class="imgl-ui-standard" x-ng-model="appData.hotspot.selected.config.popoverShow"></div>
								<label>Show on Load</label>
							</div>
							
							<div class="imgl-ui-label">Popover Placement</div>
							<div class="imgl-ui-control">
								<select class="imgl-ui-select" x-ng-model="appData.hotspot.selected.config.popoverPlacement">
									<option value="default">default</option>
									<option value="top">top</option>
									<option value="bottom">bottom</option>
									<option value="left">left</option>
									<option value="right">right</option>
									<option value="top-left">top left</option>
									<option value="top-right">top right</option>
									<option value="bottom-left">bottom left</option>
									<option value="bottom-right">bottom right</option>
								</select>
							</div>
							
							<div class="imgl-ui-label">Popover Custom Width (px)</div>
							<div class="imgl-ui-control">
								<input class="imgl-ui-number" type="number" min="0" x-ng-model="appData.hotspot.selected.config.popoverWidth" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /end hotspots section -->
		</div>
	</div>
	<div id="imgl-ui-modal" class="imgl-ui-modal" x-ng-class="{'imgl-ui-active': appData.modal}" role="dialog">
		<div class="imgl-ui-modal-dialog">
			<div class="imgl-ui-modal-content">
				<div id="imgl-ui-modal-data">
				</div>
			</div>
		</div>
	</div>
	<div id="imgl-ui-preview-wrap" x-ng-class="{'imgl-ui-active': appData.preview}">
		<div id="imgl-ui-preview-inner">
			<div id="imgl-ui-preview-canvas" x-ng-class="{'imgl-ui-active': appData.image.show}" >
				<img id="imgl-ui-preview-image" x-ng-src="{{appData.image.show ? appData.uploadUrl + appData.config.imageUrl : ''}}" x-ng-style="appData.config.imageSize == 'none' ? appData.canvas.style : {width: appData.config.imageWidth + 'px', height: appData.config.imageHeight + 'px'}" data-pin-nopin="true">
			</div>
		</div>
		<button type="button" id="imgl-ui-preview-close" aria-label="Close" x-ng-click="appData.fn.previewClose(appData);"><span aria-hidden="true">&times;</span></button>
	</div>
</div>
<!-- /end imgl-ui-wrap -->
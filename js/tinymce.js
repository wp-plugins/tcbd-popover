(function() {
	tinymce.PluginManager.add('tcbd_popover_mce_button', function( editor, url ) {
		editor.addButton( 'tcbd_popover_mce_button', {
			icon: false,
			type: 'menubutton',
			title: 'TCBD Popover',
			image : url + '/icon.png',
			menu: [
				{
				text: 'TCBD Popover Link',
				onclick: function() {
					editor.windowManager.open( {
						title: 'TCBD Popover Link',
						body: [
							{
								type: 'textbox',
								name: 'linktitleBox',
								label: 'Link Title'
							},
							{
								type: 'textbox',
								name: 'urlBox',
								label: 'Link URL'
							},
							{
								type: 'textbox',
								name: 'popovertitleBox',
								label: 'Popover Title'
							},
							{
								type: 'textbox',
								name: 'popovercontentBox',
								label: 'Popover Text',
								multiline: true,
								minWidth: 300,
								minHeight: 100
							},
							{
								type: 'listbox',
								name: 'placmentbox',
								label: 'Place',
								'values': [
									{text: 'Top', value: 'top'},
									{text: 'Bottom', value: 'bottom'},
									{text: 'Right', value: 'right'},
									{text: 'Left', value: 'left'}
								]
							}
						],
						onsubmit: function( e ) {
							editor.insertContent( '[tcbd-popover-link title="' + e.data.popovertitleBox + '" url="' + e.data.urlBox + '" text="' + e.data.popovercontentBox + '" place="' + e.data.placmentbox + '"]' + e.data.linktitleBox + '[/tcbd-popover-link]');
						}
					});
				}
				},
				{
				text: 'TCBD Popover Text',
				onclick: function() {
					editor.windowManager.open( {
						title: 'TCBD Popover Text',
						body: [
							{
								type: 'textbox',
								name: 'linktitleBox',
								label: 'Text Title'
							},
							{
								type: 'textbox',
								name: 'popovertitleBox',
								label: 'Popover Title'
							},
							{
								type: 'textbox',
								name: 'popovercontentBox',
								label: 'Popover Text',
								multiline: true,
								minWidth: 300,
								minHeight: 100
							},
							{
								type: 'listbox',
								name: 'placmentbox',
								label: 'Place',
								'values': [
									{text: 'Top', value: 'top'},
									{text: 'Bottom', value: 'bottom'},
									{text: 'Right', value: 'right'},
									{text: 'Left', value: 'left'}
								]
							}
						],
						onsubmit: function( e ) {
							editor.insertContent( '[tcbd-popover title="' + e.data.popovertitleBox + '" text="' + e.data.popovercontentBox + '" place="' + e.data.placmentbox + '"]' + e.data.linktitleBox + '[/tcbd-popover]');
						}
					});
				}
				}
			]
		});
	});
})();
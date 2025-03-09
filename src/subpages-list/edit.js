/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, Placeholder, Spinner } from '@wordpress/components';
import { useSelect } from "@wordpress/data";

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ setAttributes }) {

	// Get the current post ID
	const postId = wp.data.select("core/editor").getCurrentPostId();
	setAttributes({ parentId: postId });

	// Fetch child pages using the REST API
	const subpages = useSelect((select) => {
		return select("core").getEntityRecords("postType", "page", {
			parent: postId,
			per_page: -1,
		});
	}, []);

	return (
		<>
			<div {...useBlockProps()}>
					{!subpages && <Spinner />}
					{subpages && subpages.length > 0 ? (
						<ul>
							{subpages.map((page) => (
								<li key={page.id}>
									<a href={page.link}>{page.title.rendered}</a>
								</li>
							))}
						</ul>
					) : (
						<p>{__("No subpages found.", "custom-blocks")}</p>
					)}		
			</div>

		</>
	);
}

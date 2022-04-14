import ServerSideRender from "@wordpress/server-side-render";
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import {
	DateTimePicker,
	PanelBody,
	ToggleControl
} from "@wordpress/components";

export default props => {
	const {
		attributes,
		setAttributes
	} = props;

	const blockProps = useBlockProps();

	const { date, isBefore } = attributes;
	return (
		<>
			<InspectorControls>
				<PanelBody>
					<DateTimePicker
						currentDate={date}
						onChange={date => setAttributes({ date })}
						is12Hour={false}
					/>
					<ToggleControl
						label={"Comparison"}
						checked={isBefore}
						help={isBefore ? "Is before date." : "Is after date."}
						onChange={value => setAttributes({ isBefore: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				<ServerSideRender
					block="gemeindetag/workshops"
					attributes={attributes}
				/>
			</div>
		</>
	);
};

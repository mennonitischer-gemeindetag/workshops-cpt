import {
	TimePicker,
	TextControl,
	TextareaControl,
	CheckboxControl,
	RangeControl,
	ToggleControl
} from "@wordpress/components";
import { useBlockProps } from '@wordpress/block-editor';
import { useEntityProp } from '@wordpress/core-data';

import "./editor.css";

export default function BlockEdit () {
	const blockProps = useBlockProps();

	const [ meta, setMeta ] = useEntityProp( 'postType', 'workshops', 'meta' );

	const {
		leiter,
		character,
		beschreibung,
		beschraenkt,
		maxPlaetze,
		nr,
		endZeit,
		startZeit,
		preis,
		registrationClosed
	} = meta

	return (
		<>
			<div {...blockProps}>
				<RangeControl
					label="Workshop Nummer"
					value={nr}
					onChange={nr => setMeta({ nr })}
					min={1}
					max={100}
				/>
				<TextControl
					label={"Character"}
					value={character}
					onChange={character => setMeta({ character })}
				/>
				<TextControl
					label={"Leiter"}
					value={leiter}
					onChange={leiter => setMeta({ leiter })}
				/>
				<TextareaControl
					label={"Beschreibung"}
					value={beschreibung}
					onChange={beschreibung => setMeta({ beschreibung })}
				/>
				<TextControl
					label={"Preis"}
					value={preis}
					onChange={preis => setMeta({ preis })}
				/>
				<CheckboxControl
					label={"Beschränkte Anzahl an Teilnehmern"}
					checked={beschraenkt}
					onChange={beschraenkt => setMeta({ beschraenkt })}
				/>
				{beschraenkt && (
					<RangeControl
						label="Maximale Plätze"
						value={maxPlaetze}
						onChange={maxPlaetze => setMeta({ maxPlaetze })}
						min={1}
						max={100}
					/>
				)}
				<div className={`gemiendetage-tiles`}>
					<span className={`gemeindetage-time-picker`}>
						<label htmlFor="startZeitPicker">Start Zeit</label>
						<TimePicker
							id="startZeitPicker"
							currentTime={startZeit}
							onChange={newDate => setMeta({ startZeit: newDate })}
							is12Hour={false}
						/>
					</span>
					<span className={`gemeindetage-time-picker`}>
						<label htmlFor="endZeitPicker">End Zeit</label>
						<TimePicker
							id="endZeitPicker"
							currentTime={endZeit}
							onChange={newDate => setMeta({ endZeit: newDate })}
							is12Hour={false}
						/>
					</span>
				</div>
				<ToggleControl
					label="Registration Closed"
					checked={registrationClosed}
					onChange={(newValue) => setMeta({ registrationClosed: newValue })}
				/>
			</div>
		</>
	);
};

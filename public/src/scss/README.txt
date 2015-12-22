This structure is a slightly modified and combined version of BEM (Block, Element, Modifier)
and SMACSS (Scalable and Modular Architecture for CSS).


***Suggested folder and file structure:
/variables
	-Colors, sizes, @font-face rules
/abstractions
	-Abstracted elements that can be extended in other components. Font styles, buttons,
	and so on. Might be useful to use the % selector in SASS, which won't be rendered
	unless it is extended somewhere.
/base
	-Resets, typography and base elements (generic forms, tables, lists etc)
/components
	-Any single component. For example navigation, sliders, custom forms.
/layout
	-Actual structure of the page, or the "Glue" that combines components together.


***Suggested selector style:
.element__elementpart--modifier

For example:
.button {}
.button--big {}
.button__wrapper {}

&lt;div class="button__wrapper"&gt;
	&lt;a href="http://zombo.com" class="button button--big"&gt;Click me :)&lt;/a&gt;
&lt;/div&gt;

The goal is to make components reusable and to reduce nesting (and specifity wars) as much
as possible.


***Read more:
BEM: https://en.bem.info
SMACSS: https://smacss.com/

If you have questions ask Juho:
juho.lehmonen@mirumagency.com

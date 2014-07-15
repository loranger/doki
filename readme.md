# Wiki Doki

Doki is a simple [wiki](http://en.wikipedia.org/wiki/Wiki) rendering engine based on [Laravel 4](http://laravel.com/), using [markdown](http://en.wikipedia.org/wiki/Markdown) as syntax.

Doki does not require any database. It uses the filesystem in order to browse and render the pages.


## Installation

* Clone this project:

```bash
$ git clone https://github.com/loranger/doki.git mywiki
```

* Enter your new wiki:

```bash
$ cd mywiki
```

* Make sure you have all the (very latest version of the doki) dependencies:

```bash
$ composer update
```

* Edit your homepage:

```bash
$ `echo $EDITOR` wiki/README.md
```
(of course, you can use your own IDE instead)
(no, really, go ahead, use your own)

* You're ready to rumble!

## Good to know

* `wiki` is the default content folder. Fell free to symlink it, git-submodule it, etc...
* Empty sub directories will be rendered as a folder tree. Except if a `readme` or `README`file is found, using a markdown extension : `markdown, mdown, mkdn, md, mkd, mdwn, mdtxt, mdtext or text`

## I need a custom theme, I want my own wiki!

#### Please do!

You only have to tinker with `app/views/*` and `app/assets/*`.

`app/views/` is where the global layout, the wiki template and the ui views are stored.


`app/assets/` stores the asset files. They are automatically rendered/concatenated/minified using [Gulp](http://gulpjs.com/).

#### How-to

Make sure you have all the needed tools:

```bash
$ npm install
```
Then, trigger your gulp:

```bash
$ gulp dev
```
is usefull to automatically watch folder and build the assets on-the-fly.

```bash
$ gulp prod
```
will build and optimize files for prod.

## TODO

* I have to clean this repository and make it a clean release.
* In a near future this folder will be a configuration variable you will could move around.
* Error pages are missing

## Respect

Doki could not be Doki without
* [MrJuliuss](https://github.com/MrJuliuss/)
* [Laravel](http://laravel.com/)
* [ParseDown](http://parsedown.org/)
* [Bootstrap](http://getbootstrap.com/)
* [jQuery](http://jquery.com/)
* [Gulp](http://gulpjs.com/)
* [Prism](http://prismjs.com/)

My Kodus goes to all of them. Thank you so much.

---

♡ Copying is an act of love. Please copy.
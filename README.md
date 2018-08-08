# Fix Me a Link for Craft 3
A Craft plugin with link utility functions.

## Link Obfuscator for Assets Files

Using the following Twig filter in your template:

```
{% for asset in entry.assets %}
    <a href="{{ asset|obfuscateAssetUrl }}">{{ asset.extension }}</a>
{% endfor %}
```

will insert a database record with a unique hash for that URL, and provide a Craft URL with that hash. It will output the binary file under that URL to obfuscate its true location.

Obfuscated URLs expire in 15 minutes so they can't be shared.

We're using this on a community site for logged-in members with PDF files stored on Amazon S3, where we don't want those URLs getting out in the wild.

There's also a filter for:

```
<a href="{{ entry.url|obfuscate }}"
```

which will also store a link and a hash, but it currently just redirects to the URL when clicked.

## History

Quick start to get this working for Assets on a client's site. More to come!

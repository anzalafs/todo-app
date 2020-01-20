<h2>Installation</h2>
<p>Clone Repository</p>
<pre>git clone https://github.com/anzalafs/todo-app.git</pre>
<p>Create a database named "servme_test"</p>
<p>Then cd into the folder with this command-</p>
<pre><code>cd todo-app
</code></pre>
<p>Then do a composer install</p>
<pre><code>composer install
</code></pre>
<p>Edit .env file with appropriate credential for the database.</p>
<p>Do a database migration using following command</p>
<pre>php artisan migrate</pre>
<h2>Run server</h2>
<p>test.postman_collection.json file contains all api requests</p>
<p>Import "test.postman_collection.json" file into postman</p>

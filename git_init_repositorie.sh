git init
git config --global user.name "rochevin"
git config --global user.email "vincent.rocher@etu.univ-rouen.fr"
git add .
git commit -m "first commit"
git remote add origin git@github.com:rochevin/$1
git push -u origin master
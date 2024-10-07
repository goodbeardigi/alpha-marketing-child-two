# Introduction 
This is the child theme template that is provided on a new site build.
As per standard WordPress practices, any edits should be made here in the child theme instead of in the parent theme.
Any updates to the parent will override changes made there.

# Getting Started
1.	Installation process
    Just clone and deploy into the `wp-content/themes` directory of a WordPress site install. It requires the Alpha theme to be installed as well. The alpha theme should be installed into a directory called `alpha-marketing-theme`
2. Ensure git-updater plugin is installed
3. Update the theme through the normal WordPress update process. git-updater plugin will handle pulling new versions from git.

# Deploying a new version
The child theme can be deployed using a combination of branch name and version number. These are specified in the style.css file. The child theme is version controlled in Github and in Azure. Azure is our canonical repo and github is just used for deployments/versioning. The git-updater plugin uses the github url to look for updates.
```
Primary Branch: pre-release
Version: 1.0.1
```
The primary branch should match the environment you want to deploy to. 

```
main --> production
pre-release --> staging
develop --> development
```

Ensure your branch name matches the right environment - if you push to main, every installation linking to this in production will receive that update so take your time - if you dont know what you are doing - then dont touch it.

An update in any environment is triggered by the version number in the style.css file under the `Version` title to be higher in the repo than in the WordPress site. if it is an update will be triggered.

To perform an update:

1. Bump the version number and commit your changes to the Azure repo.  
2. merge into pre-release and tag the branch with the version number.
3. ensure the github repo is added as a new remote `git remote add deploy git@github.com:alpha-global/alpha-marketing-child-theme.git`
4. push the changes to github git push deploy {pre-release or another branch name}
5. **always** ensure the branch name matches the target branch in style.css
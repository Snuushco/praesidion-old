import requests
import os

# Create images directory if it doesn't exist
if not os.path.exists('images'):
    os.makedirs('images')

# Image URLs
images = {
    'hero-bg.jpg': 'https://images.unsplash.com/photo-1581092921461-39b9d08a9b21?q=80&w=1920&auto=format&fit=crop',
    'objectbeveiliging.jpg': 'https://images.unsplash.com/photo-1581092921461-39b9d08a9b21?q=80&w=800&auto=format&fit=crop',
    'surveillance.jpg': 'https://images.unsplash.com/photo-1581092921461-39b9d08a9b21?q=80&w=800&auto=format&fit=crop',
    'toegangscontrole.jpg': 'https://images.unsplash.com/photo-1581092921461-39b9d08a9b21?q=80&w=800&auto=format&fit=crop',
    'team.jpg': 'https://images.unsplash.com/photo-1581092921461-39b9d08a9b21?q=80&w=800&auto=format&fit=crop'
}

# Download each image
for filename, url in images.items():
    try:
        response = requests.get(url)
        if response.status_code == 200:
            with open(os.path.join('images', filename), 'wb') as f:
                f.write(response.content)
            print(f'Successfully downloaded {filename}')
        else:
            print(f'Failed to download {filename}: Status code {response.status_code}')
    except Exception as e:
        print(f'Error downloading {filename}: {str(e)}') 
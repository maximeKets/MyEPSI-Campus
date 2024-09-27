import asyncio
from pyppeteer import launch
from bs4 import BeautifulSoup
from datetime import datetime


# Function to map the day of the week to the corresponding div range
def get_div_range_for_day(day_of_week):
    day_mapping = {
        0: (0, 2),  # Monday: first two divs
        1: (2, 4),  # Tuesday: next two divs
        2: (4, 6),  # Wednesday: next two divs
        3: (6, 8),  # Thursday: next two divs
        4: (8, 10),  # Friday: next two divs
    }
    return day_mapping.get(day_of_week, (0, 2))  # Default to Monday if not found


# Function to clean and extract relevant info from the divs
def extract_course_info(specific_div):
    courses = []

    for div in specific_div:
        # Extract course title, teacher, time, room
        course_title = div.find('td', class_='TCase').text.strip()
        hours = div.find('td', class_='TChdeb').text.strip()
        room = div.find('td', class_='TCSalle').text.strip()
        td_prof = div.find('td', class_='TCProf')
        teacher = td_prof.contents[1].strip()  # Text before <br>
        promotion = td_prof.contents[3].strip()  # Text after <br>

        # Store in a dictionary
        course_info = {
            'course_title': course_title,
            'teacher': teacher,
            'promotion': promotion,
            'hours': hours,
            'room': room
        }
        courses.append(course_info)

    return courses


def clean_soup_html(soup):
    # Clean unwanted elements
    for script in soup(["script", "style", "nav", "footer", "a", "button", "img"]):
        script.extract()

    # Get only the 'Case' divs
    specific_div = soup.find_all('div', class_='Case')

    # Get the current day of the week (0 = Monday, 6 = Sunday)
    today = datetime.now().weekday()

    # Get the range of divs to process based on the day
    div_range = get_div_range_for_day(today)
    selected_divs = specific_div[div_range[0]:div_range[1]]

    # Extract course information
    course_info = extract_course_info(selected_divs)

    return course_info


def get_week_dates():
    # Get the current date
    today = datetime.now()
    today_str = today.strftime('%m/%d/%Y')
    return today_str


def generate_url(date):
    return f"https://ws-edt-cd.wigorservices.net/WebPsDyn.aspx?action=posEDTLMS&serverID=C&Tel=maxime.kets&date={date}&hashURL=AB334BEFC700276E01BD920EA4D4098838B587C2EE764A765DD6050F5746D5725600252065C3FE9306974BC67400BD379AD80FA5096E02EA176989B0403189DE"


async def launch_browser_with_extension():
    # Launch the browser with extensions and specified window dimensions
    browser = await launch(headless=False,
                           args=[
                               '--start-maximized',
                               '--disable-gpu',
                               '--disable-dev-shm-usage',
                               '--disable-setuid-sandbox',
                               '--no-first-run',
                               '--no-sandbox',
                               '--no-zygote',
                               '--deterministic-fetch',
                               '--disable-features=IsolateOrigins',
                               '--disable-site-isolation-trials',
                           ])
    return browser


async def fill_username(page):
    # Fill the username input field
    await page.type('#username', 'maxime.kets')


async def fill_password(page):
    # Fill the password input field
    await page.type('#password', 'P?qWqHsm2Cbft.*')


async def open_page(browser, url):
    # Open the page with the provided URL
    page = await browser.newPage()
    await page.goto(url, {'waitUntil': 'networkidle2', 'timeout': 60000})  # Wait until network is idle
    return page



if __name__ == "__main__":
    async def main():
        browser = None
        page = None
        try:
            # Launch the browser and load the page
            browser = await launch_browser_with_extension()
            date = get_week_dates()
            url = generate_url(date)
            page = await open_page(browser, url)
            await fill_username(page)
            await fill_password(page)
            await page.click('button[type="submit"]')
            await page.waitForNavigation()

            # Extract the page content and parse it with BeautifulSoup
            content = await page.content()
            soup = BeautifulSoup(content, 'html.parser')

            # Clean and process the HTML content
            clean_content = clean_soup_html(soup)
            print(clean_content)

        except Exception as e:
            print(e)
        finally:
            if page:
                await page.close()
            if browser:
                await browser.close()


    asyncio.get_event_loop().run_until_complete(main())

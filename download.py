from __future__ import print_function

from google.oauth2 import service_account
from googleapiclient.discovery import build
from googleapiclient.errors import HttpError


def search_file(DRIVE_ID,writefile):

    SCOPES = ['https://www.googleapis.com/auth/drive']
    SERVICE_ACCOUNT_FILE = 'credentials1.json'  # 金鑰檔案

    # 建立憑證物件
    creds = service_account.Credentials.from_service_account_file(
        SERVICE_ACCOUNT_FILE, scopes=SCOPES)

    try:
        # create drive api client
        service = build('drive', 'v3', credentials=creds)
        files = []
        page_token = None
        while True:
            # pylint: disable=maybe-no-member
            response = service.files().list(q = "parents in '{}'".format(DRIVE_ID),
                                            fields='nextPageToken, '
                                                    'files(id, name, parents )',
                                            supportsAllDrives=True,
                                            includeItemsFromAllDrives = True,
                                            pageToken=page_token).execute()
            for file in response.get('files', []):
                writefile.write(file.get("id")+', ')
                print(F'Found file: {file.get("name")}, {file.get("id")}')
            print("end")
            files.extend(response.get('files', []))
            page_token = response.get('nextPageToken', None)
            if page_token is None:
                break

    except HttpError as error:
        print(F'An error occurred: {error}')
        files = None

    return files


if __name__ == '__main__':
    hfile = open("../word/video_ref_horizontal.txt", "w")
    hfile.truncate(0)
    sfile = open("../word/video_ref_straight.txt", "w")
    sfile.truncate(0)
    search_file('1JVCUKzvyCJpJoTRd3zUO0srk2n-aOpDz',hfile)
    search_file('1JVCUKzvyCJpJoTRd3zUO0srk2n-aOpDz',sfile)
    hfile.close()
    sfile.close()

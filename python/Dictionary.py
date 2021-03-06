import pickle
class Dictionary(object):
    """docstring for Dictionary"""
    def __init__(self):
        self.loadDict()

    def loadDict(self):
        self.dict = pickle.load(open('dictionary/dictionaryPickle.p', 'rb'))

    def getPartOfSpeech(self, word):
        try: 
            return self.dict[word.upper()]
        except KeyError:
            return 'Not Found In Dictionary'